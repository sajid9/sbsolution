<?php

namespace App\Http\Controllers\opening;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\stock;
use App\item_ledger;
use App\items;
use App\suppliers;
use App\customers;
use App\cash;
use App\supplier_history;
use App\customer_ledger;
use DB;
class opening_controller extends Controller
{	
    public function addItem(){
    	$items = items::all();
    	return view('pages.opening.opening_item_form',compact('items'));
    }
    public function save_item(Request $request){
    	if(stock::where('item_id',$request->itemId)->first()){
            $stock = stock::where('item_id',$request->itemId)->increment('qty',$request->quantity);
        }else{
            $stock = new stock;
            $stock->item_id = $request->itemId;
            $stock->qty = $request->quantity;
            $stock->save();
        }
        $stock = stock::where('item_id',$request->itemId)->first();
        $ledger = new item_ledger;
        $ledger->item_id = $request->itemId;
        $ledger->purchase = $request->quantity;
        $ledger->description = 'Opening';
        $ledger->left     = $stock->qty;
        $ledger->save();
    	return json_encode(['message'=>'success']);
    }
    public function supplier(){
    	$suppliers = suppliers::all();
    	return view('pages.opening.opening_supplier_form',compact('suppliers'));
    }
    public function save_supplier(Request $request){
    	$sup_bal = DB::table('supplier_history')->select(DB::raw('SUM(debit) - SUM(credit) as balance'))->where('supplier_id',$request->supplier)->first();
    	$ledger = new supplier_history;
    	$ledger->supplier_id = $request->supplier;
    	if($request->type == 'debit'){
    		$ledger->debit = $request->amount;
    		$ledger->balance = ($sup_bal->balance != null)? $sup_bal->balance + $request->amount:$request->amount;
    	}else{
    		$ledger->credit = $request->amount;
    		$ledger->balance = ($sup_bal->balance != null)? $sup_bal->balance - $request->amount:$request->amount;
    	}
    	$ledger->type = 'OP';
    	$ledger->save();
    	return json_encode(['message'=> 'success']);
    }
    public function customer(){
    	$customers = customers::all();
    	return view('pages.opening.opening_customer_form',compact('customers'));
    }
    public function save_customer(Request $request){
    	$sup_bal = DB::table('customer_ledger')->select(DB::raw('SUM(debit) - SUM(credit) as balance'))->where('customer_id',$request->customer)->first();
    	$ledger = new customer_ledger;
    	$ledger->customer_id = $request->customer;
    	if($request->type == 'debit'){
    		$ledger->debit = $request->amount;
    		$ledger->balance = ($sup_bal->balance != null)? $sup_bal->balance + $request->amount:$request->amount;
    	}else{
    		$ledger->credit = $request->amount;
    		$ledger->balance = ($sup_bal->balance != null)? $sup_bal->balance - $request->amount:$request->amount;
    	}
    	$ledger->type = 'OP';
    	$ledger->save();
    	return json_encode(['message'=> 'success']);
    }
    public function opening_cash(){
        return view('pages.opening.opening_cash_form');
    }
    public function save_cash(Request $request){
        $check = DB::table('cash')->where('event','OP')->get();
        if(sizeof($check) > 0){
            return json_encode(['message'=>'exsist']);
        }else{
            $sup_bal = DB::table('cash')->select(DB::raw('SUM(debit) - SUM(credit) as balance'))->first();
            $cash = new cash;
            if($request->type == 'debit'){
                $cash->debit = $request->amount;
                $cash->balance = ($sup_bal->balance != null)? $sup_bal->balance + $request->amount:$request->amount;
            }else{
                $cash->credit = $request->amount;
                $cash->balance = ($sup_bal->balance != null)? $sup_bal->balance - $request->amount:$request->amount;
            }
            $cash->event = 'OP';
            $cash->desc  = $request->description;
            $cash->save();
            return json_encode(['message'=>'success']);
        }
    }
}

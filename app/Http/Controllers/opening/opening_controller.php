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
use App\accounts;
use App\stores;
use App\payments;
use DB;
class opening_controller extends Controller
{	
    public function addItem(){
    	$items  = items::all();
        $stores = stores::all(); 
    	return view('pages.opening.opening_item_form',compact('items','stores'));
    }
    public function save_item(Request $request){
        $request->validate([
            'store' =>'required'
        ]);
        $check = item_ledger::where('item_id',$request->item_id)->where('store',$request->store)->where('description','Opening')->get();
        if(sizeof($check) > 0){
            return redirect()->to('opening/addItem')->with('error','opening already exsist');
        }
    	if(stock::where('item_id',$request->item_id)->where('store',$request->store)->first()){
            $stock = stock::where('item_id',$request->item_id)->where('store',$request->store)->increment('qty',$request->quantity);
        }else{
            $stock = new stock;
            $stock->item_id = $request->item_id;
            $stock->qty = $request->quantity;
            $stock->store = $request->store;
            $stock->save();
        }
        $stock = stock::where('item_id',$request->item_id)->where('store',$request->store)->first();
        $ledger = new item_ledger;
        $ledger->item_id = $request->item_id;
        $ledger->purchase = $request->quantity;
        $ledger->description = 'Opening';
        $ledger->left     = $stock->qty;
        $ledger->store    = $request->store;
        $ledger->save();
    	return redirect()->to('opening/addItem')->with('message','Opening Added Successfully');
    }
    public function supplier(){
    	$suppliers = suppliers::all();
    	return view('pages.opening.opening_supplier_form',compact('suppliers'));
    }
    public function save_supplier(Request $request){
        $check = DB::table('supplier_history')->where('type','OP')->where('supplier_id',$request->supplier)->get();
        if(sizeof($check) == 0){
            $sup_bal = DB::table('supplier_history')->select(DB::raw('SUM(credit) - SUM(debit) as balance'))->where('supplier_id',$request->supplier)->first();
            $ledger = new supplier_history;
            $ledger->supplier_id = $request->supplier;
            if($request->type == 'debit'){
                $ledger->debit = $request->amount;
                $ledger->balance = ($sup_bal->balance != null)? $sup_bal->balance - $request->amount:$request->amount;
            }else{
                $ledger->credit = $request->amount;
                $ledger->balance = ($sup_bal->balance != null)? $sup_bal->balance + $request->amount:$request->amount;
            }
            $ledger->type = 'OP';
            $ledger->save();
            return json_encode(['message'=> 'Record Added Successfully']);
        }else{
            return json_encode(['message'=> 'Already Exsist']);
        }
    	
    	
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
    public function opening_account(){
        return view('pages.opening.opening_account_form');
    }
    public function save_account(Request $request){
        $request->validate([
            "title"=>"required",
            "date"=>"required",
            "amount"=>"required"
        ]);

        $account = new accounts;
        $account->account_title = $request->title;
        $account->date = $request->date;
        $account->balance = $request->amount;
        $account->left_bal = $request->amount;
        $account->branch_name = $request->branchname;
        $account->branch_code = $request->branchcode;
        $account->account_number = $request->accountno;
        $account->save();

        return redirect()->back()->with('message','Record added successfully');
    }
    public function account_listing(){
        $accounts = accounts::all();
        return view('pages.opening.opening_account_listing',compact('accounts'));
    }
    public function cash_deposit()
    {
        $accounts = accounts::all();
        return view('pages.opening.cash_deposit_form',compact('accounts'));
    }
    public function save_deposit(Request $request)
    {
        $request->validate([
            'account'=>'required',
            'amount'=>'required',
            'date'=>'required',
            'remarks'=>'required',
            'type'=>'required',
        ]);
        $account = accounts::find($request->account);
        if($request->type == 'deposit'){
            $account->left_bal += $request->amount;
        }else{
            $account->left_bal -= $request->amount;
        }
        $account->save();
        $payment = new payments;
        $payment->account_id = $request->account;
        if($request->type == 'deposit'){
            $payment->credit = $request->amount;
            $payment->type   = 'deposit';
        }else{
            $payment->debit = $request->amount;
            $payment->type   = 'withdraw';
        }
        
        $payment->remarks = $request->remarks;
        $payment->save();
        return redirect()->back()->with('message','Cash Deposit Successfully');
    }
}

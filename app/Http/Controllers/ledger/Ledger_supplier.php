<?php

namespace App\Http\Controllers\ledger;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\supplier_ledger;
use App\supplier_history;
use App\suppliers;
use App\voucher;
use App\receipt;
use App\customers;
use DB;
use CH;
class Ledger_supplier extends Controller
{
    public function supplier_ledgers(){
        $id = CH::getId();
    	$ledgers =supplier_ledger::with('supplier','voucher')->whereHas('voucher',function($q) use ($id){
            $q->where('user_id',$id);
        })->get();
    	return view('pages.supplierledger.supplier_ledger',compact('ledgers'));
    }

    public function supplier_history(){
        $id = CH::getId();
    	$ledgers =supplier_history::with('supplier','voucher')->whereHas('supplier',function($q) use ($id){
            $q->where('user_id',$id);
        })->get();
    	return view('pages.supplierhistory.supplier_history',compact('ledgers'));
    }
    public function get_supplier(Request $request){
        $id = CH::getId();
    	$allsuppliers = suppliers::select('id','supplier_name as text')->where('supplier_name','like','%'.$request->term.'%')->where('user_id',$id)->get();
    	return json_encode($allsuppliers);
    }
    public function search_supplier(Request $request){
    	$search = DB::table('supplier_history')->leftJoin('suppliers','suppliers.id','=','supplier_history.supplier_id');
    	if($request->supplier){
    		$search->where('supplier_id',$request->supplier);
    	}
    	if($request->from && $request->to){
    		$search->whereBetween('created_at',[$request->from,$request->to]);
    	}
    	$ledgers = $search->get();
    	return view('pages.supplierhistory.supplier_history',compact('ledgers'));
    }
    public function search_customer(Request $request){
        $search = DB::table('customer_ledger');
        if($request->customer){
            $search->where('customer_id',$request->customer);
        }
        if($request->from && $request->to){
            $search->whereBetween('created_at',[$request->from,$request->to]);
        }
        $ledgers = $search->get();
        return view('pages.customerledger.customer_ledger',compact('ledgers'));
    }
    public function search_receipt(Request $request){
        $search = DB::table('receipt_ledger');
        if($request->receipt){
            $search->where('receipt_id',$request->receipt);
        }
        if($request->from && $request->to){
            $search->whereBetween('created_at',[$request->from,$request->to]);
        }
        $ledgers = $search->get();
        return view('pages.receiptledger.receipt_ledger',compact('ledgers'));
    }
    public function get_customer(Request $request){
        $id = CH::getId();
    	$customers = customers::select('id','customer_name as text')->where('customer_name','like','%'.$request->term.'%')->where('user_id',$id)->get();
    	return json_encode($customers);
    }
    public function get_receipt(Request $request){
        $id = CH::getId();
        $receipt = receipt::select('id','receipt_no as text')->where('receipt_no','like','%'.$request->term.'%')->where('user_id',$id)->get();
        return json_encode($receipt);
    }
    public function get_voucher(Request $request){
        $id = CH::getId();
        $vouchers = voucher::select('id','voucher_no as text')->where('voucher_no','like','%'.$request->term.'%')->where('user_id',$id)->get();
        return json_encode($vouchers);
    }
    public function search_voucher(Request $request){
    	$search = DB::table('supplier_ledger');
    	if($request->voucher){
    		$search->where('voucher_id',$request->voucher);
    	}
    	if($request->from && $request->to){
    		$search->whereBetween('created_at',[$request->from,$request->to]);
    	}
    	$ledgers = $search->get();
    	return view('pages.supplierledger.supplier_ledger',compact('ledgers'));
    }
}

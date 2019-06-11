<?php

namespace App\Http\Controllers\ledger;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\supplier_ledger;
use App\supplier_history;
use App\suppliers;
use App\voucher;
use DB;
class Ledger_supplier extends Controller
{
    public function supplier_ledgers(){
    	$ledgers =supplier_ledger::all();
    	return view('pages.supplierledger.supplier_ledger',compact('ledgers'));
    }

    public function supplier_history(){
    	$ledgers =supplier_history::all();
    	return view('pages.supplierhistory.supplier_history',compact('ledgers'));
    }
    public function get_supplier(Request $request){
    	$allsuppliers = suppliers::select('id','supplier_name as text')->where('supplier_name','like','%'.$request->term.'%')->get();
    	return json_encode($allsuppliers);
    }
    public function search_supplier(Request $request){
    	$search = DB::table('supplier_history');
    	if($request->supplier){
    		$search->where('supplier_id',$request->supplier);
    	}
    	if($request->from && $request->to){
    		$search->whereBetween('created_at',[$request->from,$request->to]);
    	}
    	$ledgers = $search->get();
    	return view('pages.supplierhistory.supplier_history',compact('ledgers'));
    }
    public function get_voucher(Request $request){
    	$vouchers = voucher::select('id','voucher_no as text')->where('voucher_no','like','%'.$request->term.'%')->get();
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

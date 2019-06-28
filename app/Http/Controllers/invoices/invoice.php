<?php

namespace App\Http\Controllers\invoices;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class invoice extends Controller
{
    public function saleinvoice($id){
    	$data = DB::table('receipt')->leftJoin('customers','receipt.customer_id','=','customers.id')->where('receipt.id',$id)->first();
    	$items = DB::table('receipt_detail')->leftJoin('items','receipt_detail.item_id','=','items.id')->where('receipt_detail.type','sale')->where('receipt_detail.receipt_id',$id)->get();
    	return view('pages.invoices.sale_invoice',compact('data','items'));
    }
    
    public function salereturninvoice($id){
    	$data = DB::table('receipt')->leftJoin('customers','receipt.customer_id','=','customers.id')->where('receipt.id',$id)->first();
    	$items = DB::table('receipt_detail')->leftJoin('items','receipt_detail.item_id','=','items.id')->where('receipt_detail.type','return')->where('receipt_detail.receipt_id',$id)->get();
    	return view('pages.invoices.sale_invoice',compact('data','items'));
    }

    public function purchasereturninvoice($id){
    	$data = DB::table('voucher')->leftJoin('suppliers','voucher.supplier_id','=','suppliers.id')->where('voucher.id',$id)->first();
    	$items = DB::table('voucher_detail')->leftJoin('items','voucher_detail.item_id','=','items.id')->where('voucher_detail.type','return')->where('voucher_detail.voucher_id',$id)->get();
    	return view('pages.invoices.sale_invoice',compact('data','items'));
    }
}

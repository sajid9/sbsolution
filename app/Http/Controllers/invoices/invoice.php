<?php

namespace App\Http\Controllers\invoices;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\suppliers;
use App\customers;
use App\company_setting;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use CH;
class invoice extends Controller
{
    public function saleinvoice($id){
      $userId = CH::getId();
      $taxes = DB::table('tax')->where('user_id',$userId)->get();
    	$data = DB::table('receipt')->leftJoin('customers','receipt.customer_id','=','customers.id')->where('receipt.id',$id)->first();
    	$items = DB::table('receipt_detail')->leftJoin('items','receipt_detail.item_id','=','items.id')->where('receipt_detail.type','sale')->where('receipt_detail.receipt_id',$id)->get();
      $company = company_setting::first();
      Mail::to('softsb7@gmail.com')->send(new SendMail($data,$items,$company));
    	return view('pages.invoices.sale_invoice',compact('data','items','company','taxes'));
    }
    
    public function salereturninvoice($id){
    	$data = DB::table('receipt')->leftJoin('customers','receipt.customer_id','=','customers.id')->where('receipt.id',$id)->first();
    	$items = DB::table('receipt_detail')->leftJoin('items','receipt_detail.item_id','=','items.id')->where('receipt_detail.type','return')->where('receipt_detail.receipt_id',$id)->get();
      $company = company_setting::first();
    	return view('pages.invoices.sale_invoice',compact('data','items','company'));
    }

    public function purchasereturninvoice($id){
    	$data = DB::table('voucher')->leftJoin('suppliers','voucher.supplier_id','=','suppliers.id')->where('voucher.id',$id)->first();
    	$items = DB::table('voucher_detail')->leftJoin('items','voucher_detail.item_id','=','items.id')->where('voucher_detail.type','return')->where('voucher_detail.voucher_id',$id)->get();
      $company = company_setting::first();
    	return view('pages.invoices.purchase_return_invoice',compact('data','items','company'));
    }
    public function amountpayable(){
       $id = CH::getId(); 
       $total = DB::select('SELECT SUM(total_amount - (paid_amount + return_amount)) as total FROM voucher WHERE total_amount - (paid_amount + return_amount) > 0 AND user_id ='.$id);
       $data = DB::select('SELECT * FROM voucher Left Join suppliers ON voucher.supplier_id = suppliers.id  WHERE total_amount - (paid_amount + return_amount) > 0 AND voucher.user_id ='.$id);
       return view('pages.invoices.amount_payable_invoice',compact('total','data'));
    }
    public function amountreceivable(){
      $id = CH::getId();
       $total = DB::select('SELECT SUM(total_amount - (paid_amount + return_amount)) as total FROM receipt WHERE total_amount - (paid_amount + return_amount) > 0 AND user_id ='.$id);
       $data = DB::select('SELECT * FROM receipt Left Join customers ON receipt.customer_id = customers.id WHERE total_amount - (paid_amount + return_amount) > 0 AND receipt.user_id ='.$id);
       return view('pages.invoices.amount_receivable_invoice',compact('total','data'));
    }
    public function supplierpayable()
    {
      $id = CH::getId();
      $suppliers = suppliers::where('user_id',$id)->get();
      return view('pages.invoices.supplier_payable_form',compact('suppliers'));
    }
    public function customerreceivable()
    {
      $id = CH::getId();
      $customers = customers::where('user_id',$id)->get();
      return view('pages.invoices.customer_receivable_form',compact('customers'));
    }
    public function supplierpayableinvoice(Request $request)
    {
      $id = $request->supplier_id;
      $op_bal = DB::table('supplier_history')->where('type','OP')->where('supplier_id',$id)->get();
      $total = DB::select('SELECT SUM(total_amount - (paid_amount + return_amount)) as total FROM voucher WHERE total_amount - (paid_amount + return_amount) > 0 AND supplier_id ='.$id);
      $data = DB::select('SELECT * FROM voucher Left Join suppliers ON voucher.supplier_id = suppliers.id  WHERE total_amount - (paid_amount + return_amount) > 0 AND supplier_id ='.$id);
      return view('pages.invoices.amount_payable_invoice',compact('total','data','op_bal'));
    }
    public function customerreceivableinvoice(Request $request){
      $id = $request->customer_id;
      $op_bal = DB::table('customer_ledger')->where('type','OP')->where('customer_id',$id)->get();
       $total = DB::select('SELECT SUM(total_amount - (paid_amount + return_amount)) as total FROM receipt WHERE total_amount - (paid_amount + return_amount) > 0 AND customer_id ='.$id);
       $data = DB::select('SELECT * FROM receipt Left Join customers ON receipt.customer_id = customers.id WHERE total_amount - (paid_amount + return_amount) > 0 AND customer_id ='.$id);
       return view('pages.invoices.amount_receivable_invoice',compact('total','data','op_bal'));
    }
}

<?php

namespace App\Http\Controllers\payments;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\payments;
use App\voucher;
use App\supplier_ledger;
use App\supplier_history;
use DB;
class payment extends Controller
{
    public function paymentlisting(){
    	$payments = payments::all();
    	return view('pages.payments.payment_listing',compact('payments'));
    }

    public function addpaymentform(){
    	$vouchers = voucher::all();
    	return view('pages.payments.add_payment_form',compact('vouchers'));
    }
    public function addpayment(Request $request){
    	$payment = new payments;
    	$payment->voucher_id = $request->voucher;
    	$payment->amount = $request->amount;
    	$payment->method = $request->method;
    	$payment->voucher_id = $request->voucher;
    	$payment->save();
        DB::table('voucher')->where('id',$request->voucher)->increment('paid_amount',$request->amount);
        $sup = DB::table('voucher')->select(DB::raw('total_amount - return_amount - paid_amount as balance'))->where('id',$request->voucher)->first();
        $supplier = new supplier_ledger;
        $supplier->voucher_id = $request->voucher;
        $supplier->credit = $request->amount;
        $supplier->balance = $sup->balance;
        $supplier->type = "Payment";
        $supplier->save();
        $sup = DB::table('voucher')->select('supplier_id')->where('id',$request->voucher)->first();
        $sup_bal = DB::table('supplier_history')->select(DB::raw('SUM(debit) - SUM(credit) as balance'))->where('supplier_id',$sup->supplier_id)->first();

        $supplier_history = new supplier_history;
        $supplier_history->supplier_id = $sup->supplier_id;
        $supplier_history->credit = $request->amount;
        $supplier_history->balance = ($sup_bal->balance != null)? $sup_bal->balance - $request->amount:$$request->amount;
        $supplier_history->type = "Payment";
        $supplier_history->save();
    	return redirect()->to('payment/paymentlisting')->with('message','payment done successfully');
    }
}

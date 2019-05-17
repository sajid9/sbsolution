<?php

namespace App\Http\Controllers\payments;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\payments;
use App\voucher;
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

    	return redirect()->to('payment/paymentlisting')->with('message','payment done successfully');
    }
}

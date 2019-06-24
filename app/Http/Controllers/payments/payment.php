<?php

namespace App\Http\Controllers\payments;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\payments;
use App\voucher;
use App\receipt;
use App\supplier_ledger;
use App\supplier_history;
use App\customer_ledger;
use App\receipt_ledger;
use App\cash;
use DB;
class payment extends Controller
{
    public function paymentlisting(){
    	$payments = payments::all();
    	return view('pages.payments.payment_listing',compact('payments'));
    }

    public function addpaymentform(){
    	$vouchers = voucher::all();
        $receipts = receipt::all();
    	return view('pages.payments.add_payment_form',compact('vouchers','receipts'));
    }
    public function addsopayment(Request $request){
        dd($request->receiptId,$request->totalAmount,$request->customerId);
        return view('pages.payments.add_sopayment_form');
    }
    public function addpayment(Request $request){
        $request->validate([
            "type"=>"required",
            "amount"=>"required",
            "method"=>"required"
        ]);
    	$payment = new payments;
        if($request->voucher != null){
    	    $payment->voucher_id = $request->voucher;
            $payment->trans_type = 'credit';
        }else{
            $payment->trans_type = 'debit';
            $payment->receipt_id = $request->receipt;
        }
    	$payment->amount = $request->amount;
    	$payment->method = $request->method;
    	$payment->save();
        if($request->voucher != null){
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
            $supplier_history->balance = ($sup_bal->balance != null)? $sup_bal->balance - $request->amount:$request->amount;
            $supplier_history->type = "Payment";
            $supplier_history->save();
            $cash_bal = DB::table('cash')->select(DB::raw('SUM(debit) - SUM(credit) as balance'))->first();

            $cash = new cash;
            $cash->credit = $request->amount;
            $cash->balance = ($cash_bal->balance != null)? $cash_bal->balance - $request->amount:$request->amount;
            $cash->event = "P";
            $cash->save();
        }else{
             DB::table('receipt')->where('id',$request->receipt)->increment('paid_amount',$request->amount);
            $sup = DB::table('receipt')->select(DB::raw('total_amount - return_amount - paid_amount as balance'))->where('id',$request->receipt)->first();
            $supplier = new receipt_ledger;
            $supplier->receipt_id = $request->receipt;
            $supplier->debit = $request->amount;
            $supplier->balance = $sup->balance;
            $supplier->type = "Payment";
            $supplier->save();
            $sup = DB::table('receipt')->select('customer_id')->where('id',$request->receipt)->first();
            $sup_bal = DB::table('customer_ledger')->select(DB::raw('SUM(debit) - SUM(credit) as balance'))->where('customer_id',$sup->customer_id)->first();

            $supplier_history = new customer_ledger;
            $supplier_history->customer_id = $sup->customer_id;
            $supplier_history->debit = $request->amount;
            $supplier_history->balance = ($sup_bal->balance != null)? $sup_bal->balance + $request->amount:$request->amount;
            $supplier_history->type = "Payment";
            $supplier_history->save();
            $cash_bal = DB::table('cash')->select(DB::raw('SUM(debit) - SUM(credit) as balance'))->first();

            $cash = new cash;
            $cash->debit = $request->amount;
            $cash->balance = ($cash_bal->balance != null)? $cash_bal->balance + $request->amount:$request->amount;
            $cash->event = "S";
            $cash->save();
        }

    	return redirect()->to('payment/paymentlisting')->with('message','payment done successfully');
    }
}

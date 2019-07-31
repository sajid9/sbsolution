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
use App\customers;
use App\suppliers;
use App\accounts;
use App\financial_year;
use App\head;
use App\month;
use DB;
class payment extends Controller
{
    public function paymentlisting(){
    	$payments = payments::with('voucher','receipt','account','customer','supplier')->get();
    	return view('pages.payments.payment_listing',compact('payments'));
    }

    public function addpaymentform(){
    	$vouchers  = voucher::all();
        $receipts  = receipt::all();
        $accounts  = accounts::all();
        $customers = customers::all();
        $suppliers = suppliers::all();
        $years     = financial_year::all();
        $heads     = head::all();
        $months    = month::all();
    	return view('pages.payments.add_payment_form',compact('vouchers','receipts','accounts','customers','suppliers','years','heads','months'));
    }
    public function addsopayment(Request $request){
       $receipt = receipt::where('id',$request->receiptId)->first();
       $total = $request->totalAmount;
       $customer = customers::where('id',$request->customerId)->first();
       $accounts  = accounts::all();
       $years     = financial_year::all();
       $heads     = head::all();
       $months    = month::all();
       return view('pages.payments.add_so_payment_form',compact('receipt','customer','total','years','heads','months','accounts'));
    }
    public function addpayment(Request $request){
        
        $payment = new payments;
        $payment->account_id = $request->account;
        if($request->paytype === "PO"){
            $payment->voucher_id = $request->voucher;
            $payment->supplier_id = $request->supplier; 
            $payment->type = ($request->type == 'to') ? 'P' : 'PR';   
        }
        if($request->paytype === "DPTS"){
            $payment->supplier_id = $request->supplier; 
            $payment->type = ($request->type == 'to') ? 'P' : 'PR';   
        }
        if($request->paytype === "SO"){
            $payment->receipt_id = $request->receipt;
            $payment->customer_id = $request->customer;
            $payment->type = ($request->type == 'to') ? 'SR' : 'S';    
        }
        if($request->type === "to"){
            $payment->debit = $request->amount;
        }
        if($request->type === "from"){
            $payment->credit = $request->amount;
        }
        if($request->paytype === "EX"){
            $payment->credit   = $request->amount;
            $payment->month_id = $request->month;
            $payment->exp_desc = $request->description;
            $payment->exp_desc = $request->description;
            $payment->exp_type_id = $request->headtype;
            $payment->exp_subhead_id = $request->subhead;
            $payment->type = "EXP";
        }
        if($request->salary == "checked"){
            $payment->employee_id = $request->employee;
        }
        $payment->financial_year = $request->fn_year;
        $payment->save();
        if($request->voucher == null && $request->supplier != null){
            $sup_bal = DB::table('supplier_history')->select(DB::raw('SUM(credit) - SUM(debit) as balance'))->where('supplier_id',$request->supplier)->first();
            $supplier_history = new supplier_history;
            $supplier_history->supplier_id = $request->supplier;
            $supplier_history->debit = $request->amount;
            $supplier_history->balance = ($sup_bal->balance != null)? $sup_bal->balance - $request->amount:$request->amount;
            $supplier_history->type = "Payment";
            $supplier_history->save();
        }
        if($request->voucher != null){
            DB::table('voucher')->where('id',$request->voucher)->increment('paid_amount',$request->amount);
            $sup = DB::table('voucher')->select(DB::raw('total_amount - return_amount - paid_amount as balance'))->where('id',$request->voucher)->first();
            $supplier = new supplier_ledger;
            $supplier->voucher_id = $request->voucher;
            $supplier->debit = $request->amount;
            $supplier->balance = $sup->balance;
            $supplier->type = "Payment";
            $supplier->save();
            $sup = DB::table('voucher')->select('supplier_id')->where('id',$request->voucher)->first();
            $sup_bal = DB::table('supplier_history')->select(DB::raw('SUM(credit) - SUM(debit) as balance'))->where('supplier_id',$sup->supplier_id)->first();
            $supplier_history = new supplier_history;
            $supplier_history->supplier_id = $sup->supplier_id;
            $supplier_history->debit = $request->amount;
            $supplier_history->balance = ($sup_bal->balance != null)? $sup_bal->balance - $request->amount:$request->amount;
            $supplier_history->type = "Payment";
            $supplier_history->save();
            $cash_bal = DB::table('cash')->select(DB::raw('SUM(credit) - SUM(debit) as balance'))->first();
            $cash = new cash;
            $cash->credit = $request->amount;
            $cash->balance = ($cash_bal->balance != null)? $cash_bal->balance - $request->amount:$request->amount;
            $cash->event = "P";
            $cash->save();
        }else if($request->receipt != null){
             DB::table('receipt')->where('id',$request->receipt)->increment('paid_amount',$request->amount);
            $sup = DB::table('receipt')->select(DB::raw('total_amount - return_amount - paid_amount as balance'))->where('id',$request->receipt)->first();
            $supplier = new receipt_ledger;
            $supplier->receipt_id = $request->receipt;
            $supplier->credit = $request->amount;
            $supplier->balance = $sup->balance;
            $supplier->type = "Payment";
            $supplier->save();
            $sup = DB::table('receipt')->select('customer_id')->where('id',$request->receipt)->first();
            $sup_bal = DB::table('customer_ledger')->select(DB::raw('SUM(debit) - SUM(credit) as balance'))->where('customer_id',$sup->customer_id)->first();
            $supplier_history = new customer_ledger;
            $supplier_history->customer_id = $sup->customer_id;
            $supplier_history->credit = $request->amount;
            $supplier_history->balance = ($sup_bal->balance != null)? $sup_bal->balance - $request->amount:$request->amount;
            $supplier_history->type = "Payment";
            $supplier_history->save();
            $cash_bal = DB::table('cash')->select(DB::raw('SUM(debit) - SUM(credit) as balance'))->first();
            $cash = new cash;
            $cash->debit = $request->amount;
            $cash->balance = ($cash_bal->balance != null)? $cash_bal->balance - $request->amount:$request->amount;
            $cash->event = "S";
            $cash->save();
        }
    	return redirect()->to('payment/paymentlisting')->with('message','payment done successfully');
    }
    public function addpaymentsale(Request $request){
        DB::table('receipt')->where('id',$request->receipt)->increment('paid_amount',$request->amount);
        $sup = DB::table('receipt')->select(DB::raw('total_amount - return_amount - paid_amount as balance'))->where('id',$request->receipt)->first();
        $supplier = new receipt_ledger;
        $supplier->receipt_id = $request->receipt;
        $supplier->credit = $request->amount;
        $supplier->balance = $sup->balance;
        $supplier->type = "Payment";
        $supplier->save();
        $sup = DB::table('receipt')->select('customer_id')->where('id',$request->receipt)->first();
        $sup_bal = DB::table('customer_ledger')->select(DB::raw('SUM(debit) - SUM(credit) as balance'))->where('customer_id',$sup->customer_id)->first();

        $supplier_history = new customer_ledger;
        $supplier_history->customer_id = $sup->customer_id;
        $supplier_history->credit = $request->amount;
        $supplier_history->balance = ($sup_bal->balance != null)? $sup_bal->balance - $request->amount:$request->amount;
        $supplier_history->type = "Payment";
        $supplier_history->save();
        $cash_bal = DB::table('cash')->select(DB::raw('SUM(debit) - SUM(credit) as balance'))->first();
        $payment = new payments;
        $payment->account_id = $request->account;
        $payment->receipt_id = $request->receipt;
        $payment->customer_id = $request->customer;
        $payment->type = ($request->type == 'to') ? 'SR' : 'S';    
        $payment->credit = $request->amount;
        $payment->financial_year = $request->fn_year;
        $payment->save();

        $cash = new cash;
        $cash->debit = $request->amount;
        $cash->balance = ($cash_bal->balance != null)? $cash_bal->balance + $request->amount:$request->amount;
        $cash->event = "S";
        $cash->save();
        return redirect()->to('invoice/sale/'.$request->receipt);
    }

    public function financialyear(){
        $years = financial_year::all();
        return view('pages.payments.financial_year_listing',compact('years'));
    }
    public function addfinancialyear(){
        return view('pages.payments.add_financial_year_form');
    }
    public function add_fnyear(Request $request){
        $request->validate(['fn_year' => 'required|unique:financial_year,year']);
        $year = new financial_year;
        $year->year = $request->fn_year;
        $year->save();
        return redirect()->to('payment/financialyear')->with('message','Record Added Successfully');
    }
    public function delete_year($id){
        $year = financial_year::find($id);
        $year->delete();
        return redirect()->to('payment/financialyear');
    }
    public function check_paid_amount(Request $request)
    {
        $voucher = voucher::find($request->voucher);
        return json_encode($voucher);
    }
}

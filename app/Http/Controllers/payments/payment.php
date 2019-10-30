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
use CH;
class payment extends Controller
{
    public function paymentlisting(){
        $id = CH::getId();
    	$payments = payments::with('voucher','receipt','account','customer','supplier')->where('user_id',$id)->get();
    	return view('pages.payments.payment_listing',compact('payments'));
    }

    public function addpaymentform(){
        $id = CH::getId();
    	$vouchers  = voucher::where('user_id',$id)->get();
        $receipts  = receipt::where('user_id',$id)->get();
        $accounts  = accounts::where('user_id',$id)->get();
        $customers = customers::where('user_id',$id)->get();
        $suppliers = suppliers::where('user_id',$id)->get();
        $years     = financial_year::where('user_id',$id)->get();
        $heads     = head::where('user_id',$id)->get();
        $months    = month::where('user_id',$id)->get();
    	return view('pages.payments.add_payment_form',compact('vouchers','receipts','accounts','customers','suppliers','years','heads','months'));
    }
    public function addsopayment(Request $request){
       $id = CH::getId();
       $receipt   = receipt::where('id',$request->receiptId)->first();
       $total     = $request->totalAmount;
       $customer  = customers::where('id',$request->customerId)->first();
       $accounts  = accounts::where('user_id',$id)->get();
       $years     = financial_year::where('user_id',$id)->get();
       $heads     = head::where('user_id',$id)->get();
       $months    = month::where('user_id',$id)->get();
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
        if($request->paytype === "DPFC"){
            $payment->customer_id = $request->customer; 
            $payment->type = ($request->type == 'to') ? 'SR' : 'S';   
        }
        if($request->paytype === "SO"){
            $payment->receipt_id = $request->receipt;
            $payment->customer_id = $request->customer;
            $payment->type = ($request->type == 'to') ? 'SR' : 'S';    
        }
        if($request->type === "to"){
            $payment->debit = $request->amount;
            DB::table('accounts')->where('id',$request->account)->decrement('left_bal',$request->amount);
        }
        if($request->type === "from"){
            $payment->credit = $request->amount;
            DB::table('accounts')->where('id',$request->account)->increment('left_bal',$request->amount);
        }
        if($request->paytype === "EX"){
            $payment->debit   = $request->amount;
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
         /*direct payment From Customer*/
        if($request->receipt == null && $request->customer != null){
           CH::direct_payment_customer($request->customer,$request->amount,$request->type);
        }
        /*direct payment to supplier*/
        if($request->voucher == null && $request->supplier != null){
            $check_id = CH::direct_payment_supplier($request->supplier,$request->amount);
            if($check_id != 0){
                $payment->voucher_id = $check_id;
            }
        }
        $payment->user_id = CH::getId();
        $payment->save();
        if($request->voucher != null){
            CH::payment_to_voucher($request->voucher,$request->supplier,$request->amount);
        }else if($request->receipt != null){
            CH::payment_to_receipt($request->receipt,$request->amount);
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
        $payment->payment_through = $request->pay_type;    
        $payment->payment_desc = $request->type_desc;    
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
        $id = CH::getId();
        $years = financial_year::where('user_id',$id)->get();
        return view('pages.payments.financial_year_listing',compact('years'));
    }
    public function addfinancialyear(){
        return view('pages.payments.add_financial_year_form');
    }
    public function add_fnyear(Request $request){
        $request->validate(['fn_year' => 'required|unique:financial_year,year']);
        $year = new financial_year;
        $year->year = $request->fn_year;
        $year->user_id = CH::getId();
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
    public function get_account_info(Request $request)
    {
        $account = accounts::find($request->id);
        return json_encode($account);
    }
}

<?php

namespace App\helpers;
use App\supplier_ledger;
use App\supplier_history;
use App\customer_ledger;
use DB;
class CustomHelper{

	public function convert_box($qty,$pieces_box,$meter_box){
		$boxes = intval($qty / $pieces_box);
		$pieces = $qty - ($boxes * $pieces_box);
		$meter = ($meter_box / $pieces_box) * $qty;

		$obj = array();
		$obj['boxes'] = $boxes;
		$obj['pieces'] = $pieces;
		$obj['meter'] = $meter;
		return $obj;
	}
	public function direct_payment_customer($customer_id,$amount,$type)
	{
		$sup_bal = DB::table('customer_ledger')->select(DB::raw('SUM(debit) - SUM(credit) as balance'))->where('customer_id',$customer_id)->first();

		if($type === "from"){
		    $customer = new customer_ledger;
		    $customer->customer_id = $customer_id;
		    $customer->credit = $amount;
		    $customer->balance = ($sup_bal->balance != null)? $sup_bal->balance + $amount:$amount;
		    $customer->type = "Payment";
		    $customer->save();
		}else{
		    $customer = new customer_ledger;
		    $customer->customer_id = $customer_id;
		    $customer->debit = $amount;
		    $customer->balance = ($sup_bal->balance != null)? $sup_bal->balance - $amount:$amount;
		    $customer->type = "Payment";
		    $customer->save();
		}
	}
	public function direct_payment_supplier($supplier_id,$amount)
	{
		/*check if the opening amount of supplier is paid or not if not paid then make an entry in supplier history if paid then make an entry in voucher history name supplier_ledger*/
		$check = DB::table('supplier_history')->select('*',DB::raw("(SELECT SUM(debit) as total FROM supplier_history WHERE supplier_id = ".$supplier_id." AND voucher_id IS NULL AND type = 'Payment') as total"))->where('supplier_id',$supplier_id)->where('voucher_id',NULL)->where('type','OP')->first();
		if($check->credit > $check->total){
		    $sup_bal = DB::table('supplier_history')->select(DB::raw('SUM(credit) - SUM(debit) as balance'))->where('supplier_id',$supplier_id)->first();
		    $leftamount = $check->credit - $check->total;
		    if($leftamount > $amount){
		        $supplier_history = new supplier_history;
		        $supplier_history->supplier_id = $supplier_id;
		        $supplier_history->debit = $amount;
		        $supplier_history->balance = ($sup_bal->balance != null)? $sup_bal->balance - $amount:$amount;
		        $supplier_history->type = "Payment";
		        $supplier_history->save();
		        return 0;
		    }else{
		        $left = $amount - $leftamount;
		        $supplier_history = new supplier_history;
		        $supplier_history->supplier_id = $supplier_id;
		        $supplier_history->debit = $leftamount;
		        $supplier_history->balance = ($sup_bal->balance != null)? $sup_bal->balance - $leftamount:$leftamount;
		        $supplier_history->type = "Payment";
		        $supplier_history->save();
		        /*left amount paid to voucher*/
		        $voucher = DB::table('voucher')->select('*',DB::raw("total_amount - (return_amount + paid_amount) AS balance"))->HAVING('balance','!=',0)->first();
		        $this->payment_to_voucher($voucher->id,$supplier_id,$left);
		        return $voucher->id;
		    }
		    
		}else{
			$voucher = DB::table('voucher')->select('*',DB::raw("total_amount - (return_amount + paid_amount) AS balance"))->HAVING('balance','!=',0)->first();
		   $this->payment_to_voucher($voucher->id,$supplier_id,$amount);
		   return $voucher->id;
		}
	}
	/*
	* Direct payment to supplier then the opening balance ends then this function
	*/
	public function payment_to_voucher($voucher_id,$supplier_id,$amount)
	{
	    
	    DB::table('voucher')->where('id',$voucher_id)->increment('paid_amount',$amount);
	    $sup = DB::table('voucher')->select(DB::raw('total_amount - return_amount - paid_amount as balance'))->where('id',$voucher_id)->first();
	    $supplier = new supplier_ledger;
	    $supplier->voucher_id = $voucher_id;
	    $supplier->supplier_id = $supplier_id;
	    $supplier->debit = $amount;
	    $supplier->balance = $sup->balance;
	    $supplier->type = "Payment";
	    $supplier->save();
	    $sup = DB::table('voucher')->select('supplier_id')->where('id',$voucher_id)->first();
	    $sup_bal = DB::table('supplier_history')->select(DB::raw('SUM(credit) - SUM(debit) as balance'))->where('supplier_id',$sup->supplier_id)->first();
	    $supplier_history = new supplier_history;
	    $supplier_history->supplier_id = $sup->supplier_id;
	    $supplier_history->voucher_id = $voucher_id;
	    $supplier_history->debit = $amount;
	    $supplier_history->balance = ($sup_bal->balance != null)? $sup_bal->balance - $amount:$amount;
	    $supplier_history->type = "Payment";
	    $supplier_history->save();
	    return $voucher_id;
	}

public function payment_to_receipt($receipt_id,$amount)
{
	DB::table('receipt')->where('id',$receipt_id)->increment('paid_amount',$amount);
	$sup = DB::table('receipt')->select(DB::raw('total_amount - return_amount - paid_amount as balance'))->where('id',$receipt_id)->first();
	$supplier = new receipt_ledger;
	$supplier->receipt_id = $receipt_id;
	$supplier->credit = $amount;
	$supplier->balance = $sup->balance;
	$supplier->type = "Payment";
	$supplier->save();
	$sup = DB::table('receipt')->select('customer_id')->where('id',$receipt_id)->first();
	$sup_bal = DB::table('customer_ledger')->select(DB::raw('SUM(debit) - SUM(credit) as balance'))->where('customer_id',$sup->customer_id)->first();
	$supplier_history = new customer_ledger;
	$supplier_history->customer_id = $sup->customer_id;
	$supplier_history->credit = $amount;
	$supplier_history->balance = ($sup_bal->balance != null)? $sup_bal->balance - $amount:$amount;
	$supplier_history->type = "Payment";
	$supplier_history->save();
	$cash_bal = DB::table('cash')->select(DB::raw('SUM(debit) - SUM(credit) as balance'))->first();
}
}
?>
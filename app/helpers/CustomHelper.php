<?php

namespace App\helpers;
use App\supplier_ledger;
use App\supplier_history;
use App\customer_ledger;
use App\receipt_ledger;
use App\rolesauthority;
use App\User;
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
public function getauthorities()
{
	$user = User::find(\Auth::user()->id);
	$authority =rolesauthority::where('role_id',$user->role_id)->first();
	if($authority != null){
		$authority->authority = unserialize($authority->authority);
		$authority->selected_ids = unserialize($authority->selected_ids);
	}
	return $authority;
}
public function getVendorAuthorities($value='')
{
		if(\Auth::user()->type != 'superadmin'){
			$role_id = \Auth::user()->role_id;
		    $roles = rolesauthority::where('role_id',$role_id)->first();
		    $roles->authority = unserialize($roles->authority);
		}
	    $data = array();
	    /* arrays of all menu's in future these menu's will come from database*/
	    $iteminfo = array("Add Item","Opening item","Item Ledger","Stock Report","Stores","Companies","Classes","Taxes");
	    $voucherInfo = array("Voucher","Voucher Ledger","Voucher Payable","Direct In","Add Suppliers","Opening Suppliers","Supplier Ledger","Supplier Payable");
	    $saleInfo = array("Add Receipt","Receipt Ledger","Receipt Receivable","Direct Out");
	    $customer = array("Add Customers","Opening Customers","Customer Ledger","Customer Receivable");
	    $paymentInfo = array("Payments");
	    $accountInfo = array("Accounts","Cash Deposit","Accounts Ledger","Financial Year");
	    $expenditure = array("Heads","Months");
	    $usermanagement = array("User management");
	    $dashboard = array("Dashboard");
	    /*check id user is superadmin then all menus show*/
	    if(\Auth::user()->type == 'superadmin'){
	    	/*js tree json parent*/
	    	$data[0]["text"] = "Item Info";
	    	/*js tree json child*/
	    	$data[0]["children"] = $iteminfo;
	    	$data[1]["text"] = "Voucher Info";
	    	$data[1]["children"] = $voucherInfo;
	    	$data[2]["text"] = "Sale Info";
	    	$data[2]["children"] = $saleInfo;
	    	$data[3]["text"] = "Customer";
	    	$data[3]["children"] = $customer;
	    	$data[4]["text"] = "Payment Info";
	    	$data[4]["children"] = $paymentInfo;
	    	$data[5]["text"] = "Account Info";
	    	$data[5]["children"] = $accountInfo;
	    	$data[6]["text"] = "Expenditure";
	    	$data[6]["children"] = $expenditure;
	    	$data[7]["text"] = "User management";
	    	$data[8]["text"] = "Dashboard";
	    }else{
	    	/*define all parent menu also define its childs empty array*/
	    	$data[0]["text"] = "Item Info";
	    	$data[0]["children"] = [];
	    	$data[1]["text"] = "Voucher Info";
	    	$data[1]["children"] = [];
	    	$data[2]["text"] = "Sale Info";
	    	$data[2]["children"] = [];
	    	$data[3]["text"] = "Customer";
	    	$data[3]["children"] = [];
	    	$data[4]["text"] = "Payment Info";
	    	$data[4]["children"] = [];
	    	$data[5]["text"] = "Account Info";
	    	$data[5]["children"] = [];
	    	$data[6]["text"] = "Expenditure";
	    	$data[6]["children"] = [];
	    	
	    }
	    if(\Auth::user()->type != 'superadmin'){
	    	/*all authority coming from database*/
	    	foreach ($roles->authority as $key => $role) {
	    		/*check that role is realted to which menu and push it in its parent*/
	    	    if(in_array($role, $iteminfo)){
	    	        array_push($data[0]["children"],["text"=>$role]);
	    	    }
	    	    if(in_array($role, $voucherInfo)){
	    	        array_push($data[1]["children"],["text"=>$role]);
	    	    }
	    	    if(in_array($role, $saleInfo)){
	    	        array_push($data[2]["children"],["text"=>$role]);
	    	    }
	    	    if(in_array($role, $customer)){
	    	        array_push($data[3]["children"],["text"=>$role]);
	    	    }
	    	    if(in_array($role, $paymentInfo)){
	    	        array_push($data[4]["children"],["text"=>$role]);
	    	    }
	    	    if(in_array($role, $accountInfo)){
	    	       array_push($data[5]["children"],["text"=>$role]);
	    	    }
	    	    if(in_array($role, $expenditure)){
	    	       array_push($data[6]["children"],["text"=>$role]);
	    	    }
	    	    if(in_array($role, $usermanagement)){
	    	       $data[7]["text"] = "User management";
	    	    }
	    	    if(in_array($role, $dashboard)){
	    	       $data[8]["text"] = "Dashboard";
	    	    }
	    	}
	    }
	    /*data variable is the js tree json*/
	    return $data;
}
public function getId($value='')
{
	$id = (\Auth::user()->type == 'superadmin' || \Auth::user()->type == 'vendor') ? \Auth::user()->id : \Auth::user()->parent_id;
	return $id;
}
}
?>
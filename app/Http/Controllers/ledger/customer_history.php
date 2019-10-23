<?php

namespace App\Http\Controllers\ledger;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\customer_ledger;
use CH;
class customer_history extends Controller
{
    public function customer_ledger(){
    	$id = CH::getId();
    	$ledgers =customer_ledger::with('customer')->whereHas('customer',function($q) use ($id){
    		$q->where('user_id',$id);
    	})->get();
    	return view('pages.customerledger.customer_ledger',compact('ledgers'));
    }
}

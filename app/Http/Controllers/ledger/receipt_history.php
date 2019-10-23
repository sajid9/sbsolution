<?php

namespace App\Http\Controllers\ledger;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\receipt_ledger;
use CH;
class receipt_history extends Controller
{
    public function receipt_ledger(){
    	$id = CH::getId();
    	$ledgers =receipt_ledger::with('receipt')->whereHas('receipt',function($q) use ($id){
    		$q->where('user_id',$id);
    	})->get();
    	return view('pages.receiptledger.receipt_ledger',compact('ledgers'));
    }
}

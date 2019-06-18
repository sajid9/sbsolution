<?php

namespace App\Http\Controllers\ledger;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\receipt_ledger;
class receipt_history extends Controller
{
    public function receipt_ledger(){
    	$ledgers =receipt_ledger::all();
    	return view('pages.receiptledger.receipt_ledger',compact('ledgers'));
    }
}

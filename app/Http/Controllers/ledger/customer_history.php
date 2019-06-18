<?php

namespace App\Http\Controllers\ledger;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\customer_ledger;
class customer_history extends Controller
{
    public function customer_ledger(){
    	$ledgers =customer_ledger::all();
    	return view('pages.customerledger.customer_ledger',compact('ledgers'));
    }
}

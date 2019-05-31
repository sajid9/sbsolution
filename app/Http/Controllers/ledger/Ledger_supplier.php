<?php

namespace App\Http\Controllers\ledger;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\supplier_ledger;
use App\supplier_history;
class Ledger_supplier extends Controller
{
    public function supplier_ledgers(){
    	$ledgers =supplier_ledger::all();
    	return view('pages.supplierledger.supplier_ledger',compact('ledgers'));
    }

    public function supplier_history(){
    	$ledgers =supplier_history::all();
    	return view('pages.supplierhistory.supplier_history',compact('ledgers'));
    }
}

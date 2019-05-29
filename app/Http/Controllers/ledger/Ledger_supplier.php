<?php

namespace App\Http\Controllers\ledger;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\supplier_ledger;
class Ledger_supplier extends Controller
{
    public function supplier_ledgers(){
    	$ledgers =supplier_ledger::all();
    	return view('pages.supplierledger.supplier_ledger',compact('ledgers'));
    }
}

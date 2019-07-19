<?php

namespace App\Http\Controllers\ledger;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\accounts;
use App\payments;
use DB;
class accountledger extends Controller
{
    public function accountledgerform()
    {
    	$accounts = accounts::all();
    	return view('pages.accountledger.account_ledger_form',compact('accounts'));
    }
    public function accountledger(Request $request)
    {
        $account = DB::table('accounts')->where('id',$request->account_id)->first();
    	$total = DB::table('payments')->select(DB::raw('SUM(debit) - SUM(credit) as total'))->where('account_id',$request->account_id)->first();
    	$payments = payments::with('voucher','receipt','account','customer','supplier')->where('account_id',$request->account_id)->get();
    	return view('pages.accountledger.account_ledger',compact('payments','total','account'));
    }
}

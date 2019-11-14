<?php

namespace App\Http\Controllers\ledger;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\accounts;
use App\payments;
use DB;
use CH;
class accountledger extends Controller
{
    public function accountledgerform()
    {
        $id = CH::getId();
    	$accounts = accounts::where('user_id',$id)->get();
    	return view('pages.accountledger.account_ledger_form',compact('accounts'));
    }
    public function accountledger(Request $request)
    {
        $account = DB::table('accounts')->where('id',$request->account_id)->first();
    	$total = DB::table('payments')->select(DB::raw('SUM(debit) - SUM(credit) as total'))->where('account_id',$request->account_id)->first();
    	$payments = payments::with('voucher','receipt','account','customer','supplier')->where('account_id',$request->account_id)->get();
    	return view('pages.accountledger.account_ledger',compact('payments','total','account'));
    }
    public function stockreport($value='')
    {
        $id = CH::getId();
        $items = DB::table('stock')->leftJoin('items','items.id','=','stock.item_id')->leftJoin('stores','stores.id','=','stock.store')->where('items.user_id',$id)->get();
        foreach($items as $item){
            $item->total = DB::table('stock')->select(DB::raw('SUM(qty) as total_item'))->where('item_id',$item->item_id)->first();
        }
        
        return view('pages.invoices.stock_report',compact('items'));
    }
}

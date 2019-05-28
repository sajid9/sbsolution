<?php

namespace App\Http\Controllers\ledger;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\item_ledger;
use App\items;
class Ledger_item extends Controller
{
    public function item_ledgers(){
    	$ledgers =item_ledger::all();
    	return view('pages.itemledger.item_ledger',compact('ledgers'));
    }
    public function search_item(Request $request){
    	$items = items::select('id','item_name as text')->where('item_name','like','%'.$request->term.'%')->get();
    	return json_encode($items);
    }
}

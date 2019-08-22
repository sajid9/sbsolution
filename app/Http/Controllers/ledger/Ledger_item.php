<?php

namespace App\Http\Controllers\ledger;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\item_ledger;
use App\items;
use DB;
class Ledger_item extends Controller
{
    public function item_ledgers(){
    	$ledgers =item_ledger::with('items.groups')->get();
    	return view('pages.itemledger.item_ledger',compact('ledgers'));
    }
    public function search_item(Request $request){
    	$items = items::select('id','barcode as text')->where('barcode','like','%'.$request->term.'%')->get();
    	return json_encode($items);
    }
    public function search_itemledger(Request $request){
    	$search = item_ledger::with('items.groups');
    	if($request->item){
    		$search->where('item_id',$request->item);
    	}
    	if($request->from && $request->to){
    		$search->whereBetween('created_at',[$request->from,$request->to]);
    	}
    	$ledgers = $search->get();
    	return view('pages.itemledger.item_ledger',compact('ledgers'));
    }
}

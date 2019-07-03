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
    	$ledgers =item_ledger::with('items')->get();
    	return view('pages.itemledger.item_ledger',compact('ledgers'));
    }
    public function search_item(Request $request){
    	$items = items::select('id','item_name as text')->where('item_name','like','%'.$request->term.'%')->get();
    	return json_encode($items);
    }
    public function search_itemledger(Request $request){
    	$search = DB::table('item_ledger');
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

<?php

namespace App\Http\Controllers\ledger;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\item_ledger;
use App\items;
use App\stores;
use DB;
class Ledger_item extends Controller
{
    public function item_ledgers(){
    	$ledgers =item_ledger::with('items.groups','stores','voucher')->get();
        $stores  = stores::all();
    	return view('pages.itemledger.item_ledger',compact('ledgers','stores'));
    }
    public function search_item(Request $request){
    	$items = items::select('id','barcode as text')->where('barcode','like','%'.$request->term.'%')->get();
    	return json_encode($items);
    }
    public function search_itemledger(Request $request){
    	$total = item_ledger::select(DB::raw('SUM(purchase) - SUM(sale) as total'));
        $search = item_ledger::with('items.groups');
    	if($request->item){
    		$total->where('item_id',$request->item);
            $search->where('item_id',$request->item);
    	}
        if($request->store){
            $total->where('store',$request->store);
            $search->where('store',$request->store);
        }
    	if($request->from && $request->to){
    		$total->whereBetween('created_at',[$request->from,$request->to]);
            $search->whereBetween('created_at',[$request->from,$request->to]);
    	}
    	$total_item = $total->first();
        $ledgers = $search->get();
        $stores = stores::all();
    	return view('pages.itemledger.item_ledger',compact('ledgers',"stores",'total_item'));
    }
}

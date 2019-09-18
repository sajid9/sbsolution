<?php

namespace App\Http\Controllers\Purchase;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\voucher_receiving;
use App\item_ledger;
use App\stores;
use App\stock;
use App\voucher_detail;
use App\voucher;
use App\supplier_ledger;
use App\supplier_history;
use App\items;
use DB;
class Voucherreceiving extends Controller
{
    public function receiving_listing($voucher,$item)
    {
         $item_s = DB::table('voucher_detail')->leftJoin('voucher','voucher.id','=','voucher_detail.voucher_id')->leftJoin('items','items.id','=','voucher_detail.item_id')->where('voucher_detail.voucher_id',$voucher)->where('voucher_detail.item_id',$item)->where('voucher_detail.type','=','purchase')->first();
    	$receivings = voucher_receiving::with('item','voucher')->where('voucher_id',$voucher)->where('item_id',$item)->get();
    	return view('pages.purchase.voucher_receiving.receiving_listing',compact('receivings','item_s'));
    }
    public function add_receiving_form($voucherId,$itemId)
    {
        $item = voucher_detail::with('item')->where('voucher_id',$voucherId)->where('item_id',$itemId)->first();
        $check = DB::table('voucher_receiving')->select(DB::raw('SUM(qty) as total'))->where('voucher_id',$voucherId)->where('item_id',$itemId)->first();

        if( $check->total >= $item->qty ){
            return redirect()->back()->with('error','All items are Delivered');
        }else{
    	   return view('pages.purchase.voucher_receiving.add_receiving_form',compact('item','check'));
        }
    }
    public function add_receiving(Request $request)
    {
        $item = items::find($request->item);
    	$receiving = new voucher_receiving;
    	$receiving->voucher_id = $request->voucher;
    	$receiving->item_id = $request->item;
    	$receiving->qty = $request->quantity * $item->pieces;
    	$receiving->date = $request->date;
    	$receiving->save();
    	return redirect()->to('voucher/receivinglisting/'.$request->voucher.'/'.$request->item)->with('message','Record Added successfully');
    }
    public function receiving_store($voucher,$item,$qty,$receiving_id)
    {
        $received_item = DB::table('voucher_receiving')->leftJoin('voucher','voucher.id','voucher_receiving.voucher_id')->leftJoin('items','items.id','voucher_receiving.item_id')->where('voucher_receiving.id',$receiving_id)->first();
        $items = item_ledger::where('voucher_id',$voucher)->where('item_id',$item)->where('voucher_receiving_id',$receiving_id)->where('description','=','Purchase')->get();
        foreach($items as $item){
            $item->return_item = DB::table('item_ledger')->select(DB::raw('SUM(purchase) as returnitem'))->where('item_id',$item->item_id)->where('voucher_id',$item->voucher_id)->where('voucher_receiving_id',$receiving_id)->where('store',$item->store)->where('description','Return')->first();
            $item->item = DB::table('items')->where('id',$item->item_id)->first();
            $item->voucher = DB::table('voucher')->where('id',$voucher)->first();
            $item->storeobj = DB::table('stores')->where('id',$item->store)->first();
        }  
    	return view('pages.purchase.receiving_in_stores.receiving_store_listing',compact('items','received_item'));
    }
    public function add_receiving_store_form($voucherId,$itemId,$qty,$receivingId)
    {
    	$stores = stores::all();
        $item = items::find($itemId);
        $check = item_ledger::select(DB::raw('SUM(purchase) as total'))->where('voucher_id',$voucherId)->where('item_id',$itemId)->where('voucher_receiving_id',$receivingId)->where('description','Purchase')->first();

        if($check->total >= $qty){
            return redirect()->back()->with('error','All delivered items are added to stores');
        }else{
    	   return view('pages.purchase.receiving_in_stores.add_receiving_store_form',compact('stores','item','check'));
        }
    }
    public function add_receiving_store(Request $request)
    {
        $item = items::find($request->item);
    	if(stock::where('item_id',$request->item)->where('store',$request->store)->first()){
                $stock = stock::where('item_id',$request->item)->where('store',$request->store)->increment('qty',$request->quantity * $item->pieces);
            }else{
                $stock = new stock;
                $stock->item_id = $request->item;
                $stock->qty = $request->quantity * $item->pieces;
                $stock->store = $request->store;
                $stock->save();
            }
            $stock = stock::where('item_id',$request->item)->where('store',$request->store)->first();
            $ledger = new item_ledger;
            $ledger->item_id = $request->item;
            $ledger->purchase = $request->quantity * $item->pieces;
            $ledger->voucher_id = $request->voucher;
            $ledger->description = 'Purchase';
            $ledger->left      = $stock->qty;
            $ledger->store     = $request->store;
            $ledger->voucher_receiving_id = $request->receiving_id;
            $ledger->save();
    	
    	return redirect()->to('voucher/receivingstore/'.$request->voucher.'/'.$request->item.'/'.$request->total_qty.'/'.$request->receiving_id)->with('message','Record Added successfully');
    }
    public function return_item(Request $request){
        $item = items::find($request->item_id);
        $receiving = DB::table('voucher_receiving')->where('id',$request->receiving_id)->decrement('qty',$request->quantity * $item->pieces);
        DB::table('stock')->where('item_id',$request->item_id)->where('store',$request->store)->decrement('qty',$request->quantity * $item->pieces); 
        $stock = stock::where('item_id',$request->item_id)->where('store',$request->store)->first();
        $ledger = new item_ledger;
        $ledger->item_id = $request->item_id;
        $ledger->sale = $request->quantity * $item->pieces;
        $ledger->voucher_id = $request->voucher_id;
        $ledger->description = 'Purchase Return';
        $ledger->left     = $stock->qty;
        $ledger->store     = $request->store;
        $ledger->voucher_receiving_id = $request->receiving_id;
        $ledger->parent_id = $request->parent_id;
        $ledger->save();

        $voucher_detail = new voucher_detail;
        $voucher_detail->voucher_id = $request->voucher_id;
        $voucher_detail->item_id = $request->item_id;
        $voucher_detail->qty = $request->quantity * $item->pieces;
        $voucher_detail->purchase_price = $item->purchase_price;
        $voucher_detail->type = "return";
        $voucher_detail->save();
        
        $voucher = voucher::find($request->voucher_id);
        $voucher->return_amount +=  $item->purchase_price * ($request->quantity * $item->meter);
        $voucher->save();

        $vouch = voucher::find($request->voucher_id);
        $sup_bal = DB::table('supplier_ledger')->select(DB::raw('SUM(credit) - SUM(debit) as balance'))->where('voucher_id',$request->voucher_id)->first();
        $supplier_bal = DB::table('supplier_history')->select(DB::raw('SUM(credit) - SUM(debit) as balance'))->where('voucher_id',$request->voucher_id)->where('supplier_id',$vouch->supplier_id)->first();
        
        $voucher_history = new supplier_ledger;
        $voucher_history->voucher_id = $request->voucher_id;
        $voucher_history->supplier_id = $vouch->supplier_id;
        $voucher_history->debit = $item->purchase_price * ($request->quantity * $item->meter);
        $voucher_history->balance = $sup_bal->balance - ($item->purchase_price * ($request->quantity * $item->meter));
        $voucher_history->type = "PR";
        $voucher_history->save();
        
        $voucher_history = new supplier_history;
        $voucher_history->voucher_id = $request->voucher_id;
        $voucher_history->supplier_id = $vouch->supplier_id;
        $voucher_history->debit = $item->purchase_price * ($request->quantity * $item->meter);
        $voucher_history->balance = $supplier_bal->balance - ($item->purchase_price * ($request->quantity * $item->meter));
        $voucher_history->type = "PR";
        $voucher_history->save();
        return json_encode(['message'=>'successfully']);
    }
    public function get_returned_total(Request $request)
    {
        $return = item_ledger::select(DB::raw('SUM(sale) as total'))->where('voucher_id',$request->voucher)->where('item_id',$request->item)->where('voucher_receiving_id',$request->receiving_id)->where('parent_id',$request->parentId)->where('description','=','Purchase Return')->first();
        return json_encode($return);
    }
}

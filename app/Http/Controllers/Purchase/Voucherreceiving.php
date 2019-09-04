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
    	$receivings = voucher_receiving::where('voucher_id',$voucher)->where('item_id',$item)->get();
    	return view('pages.purchase.voucher_receiving.receiving_listing',compact('receivings'));
    }
    public function add_receiving_form()
    {
    	return view('pages.purchase.voucher_receiving.add_receiving_form');
    }
    public function add_receiving(Request $request)
    {
    	$receiving = new voucher_receiving;
    	$receiving->voucher_id = $request->voucher;
    	$receiving->item_id = $request->item;
    	$receiving->qty = $request->quantity;
    	$receiving->date = $request->date;
    	$receiving->save();
    	return redirect()->to('voucher/receivinglisting/'.$request->voucher.'/'.$request->item)->with('message','Record Added successfully');
    }
    public function receiving_store($voucher,$item,$qty,$receiving_id)
    {
    	$items = item_ledger::where('voucher_id',$voucher)->where('item_id',$item)->where('voucher_receiving_id',$receiving_id)->where('description','Purchase')->get();
    	return view('pages.purchase.receiving_in_stores.receiving_store_listing',compact('items'));
    }
    public function add_receiving_store_form($value='')
    {
    	$stores = stores::all();
    	return view('pages.purchase.receiving_in_stores.add_receiving_store_form',compact('stores'));
    }
    public function add_receiving_store(Request $request)
    {
    	if(stock::where('item_id',$request->item)->where('store',$request->store)->first()){
                $stock = stock::where('item_id',$request->item)->where('store',$request->store)->increment('qty',$request->quantity);
            }else{
                $stock = new stock;
                $stock->item_id = $request->item;
                $stock->qty = $request->quantity;
                $stock->store = $request->store;
                $stock->save();
            }
            $stock = stock::where('item_id',$request->item)->where('store',$request->store)->first();
            $ledger = new item_ledger;
            $ledger->item_id = $request->item;
            $ledger->purchase = $request->quantity;
            $ledger->voucher_id = $request->voucher;
            $ledger->description = 'Purchase';
            $ledger->left     = $stock->qty;
            $ledger->store     = $request->store;
            $ledger->voucher_receiving_id = $request->receiving_id;
            $ledger->save();
    	
    	return redirect()->to('voucher/receivingstore/'.$request->voucher.'/'.$request->item.'/'.$request->total_qty.'/'.$request->receiving_id)->with('message','Record Added successfully');
    }
    public function return_item(Request $request){
        $receiving = DB::table('voucher_receiving')->where('id',$request->receiving_id)->decrement('qty',$request->quantity); 
        $item = items::find($request->item_id);

        $voucher_detail = new voucher_detail;
        $voucher_detail->voucher_id = $request->voucher_id;
        $voucher_detail->item_id = $request->item_id;
        $voucher_detail->qty = $request->quantity;
        $voucher_detail->purchase_price = $item->purchase_price;
        $voucher_detail->type = "return";
        $voucher_detail->save();
        $stock = DB::table('stock')->where('item_id',$request->item_id)->where('store',$request->store)->decrement('qty',$request->quantity);
        $voucher = voucher::find($request->voucher_id);
        $voucher->return_amount =  $item->purchase_price * $request->quantity;
        $voucher->save();

        $vouch = voucher::find($request->voucher_id);
        $sup_bal = DB::table('supplier_ledger')->select(DB::raw('SUM(credit) - SUM(debit) as balance'))->where('voucher_id',$request->voucher_id)->first();
        $voucher_history = new supplier_ledger;
        $voucher_history->voucher_id = $request->voucher_id;
        $voucher_history->supplier_id = $vouch->supplier_id;
        $voucher_history->debit = $item->purchase_price * $request->quantity;
        $voucher_history->balance = $sup_bal->balance - ($item->purchase_price * $request->quantity);
        $voucher_history->type = "PR";
        $voucher_history->save();
        
        $voucher_history = new supplier_history;
        $voucher_history->voucher_id = $request->voucher_id;
        $voucher_history->supplier_id = $vouch->supplier_id;
        $voucher_history->debit = $item->purchase_price * $request->quantity;
        $voucher_history->balance = $sup_bal->balance - ($item->purchase_price * $request->quantity);
        $voucher_history->type = "PR";
        $voucher_history->save();
        dd($request->all());
    }
}

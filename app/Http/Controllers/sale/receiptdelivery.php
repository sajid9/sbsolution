<?php

namespace App\Http\Controllers\sale;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\receipt_delivery;
use App\item_ledger;
use App\stores;
use App\stock;
use App\receipt_detail;
use App\receipt;
use App\receipt_ledger;
use App\customer_ledger;
use App\items;
use DB;
use CH;
class receiptdelivery extends Controller
{
    public function delivery_listing($receipt,$item)
    {
        $item_p = DB::table('receipt_detail')->leftJoin('receipt','receipt.id','=','receipt_detail.receipt_id')->leftJoin('items','items.id','=','receipt_detail.item_id')->where('receipt_detail.receipt_id',$receipt)->where('receipt_detail.item_id',$item)->where('receipt_detail.type','=','sale')->first();
        /*dd($item_p);*/
    	$delivered_items = receipt_delivery::with('item')->where('receipt_id',$receipt)->where('item_id',$item)->get();
    	return view('pages.sale.item_delivered.delivered_listing',compact('delivered_items','item_p'));
    }

    public function add_delivery_form($receiptId,$itemId)
    {
        $item = receipt_detail::with('item')->where('receipt_id',$receiptId)->where('item_id',$itemId)->first();
        $check = DB::table('receipt_delivery')->select(DB::raw('SUM(qty) as total'))->where('receipt_id',$receiptId)->where('item_id',$itemId)->first();

        if( $check->total >= $item->qty ){
            return redirect()->back()->with('error','All items are Delivered');
        }else{
            return view('pages.sale.item_delivered.add_delivered_form',compact('item','check'));
        }
    	
    }
    public function add_delivery(Request $request)
    {
        $item = items::find($request->item);
        $delivery = new receipt_delivery;
        $delivery->receipt_id = $request->receipt;
        $delivery->item_id = $request->item;
        $delivery->qty = $request->quantity;
        $delivery->date = $request->date;
        $delivery->save();
        return redirect()->to('sale/deliverylisting/'.$request->receipt.'/'.$request->item)->with('message','Record Added successfully');
    }
    public function get_returned_total(Request $request)
    {
        $return = item_ledger::select(DB::raw('SUM(purchase) as total'))->where('receipt_id',$request->receipt)->where('item_id',$request->item)->where('voucher_delivery_id',$request->delivery_id)->where('parent_id',$request->parentId)->where('description','=','Return')->first();
        return json_encode($return);
    }
    public function store_listing($receipt,$item,$qty,$delivery_id)
    {
        $delivered_item = DB::table('receipt_delivery')->leftJoin('receipt','receipt.id','receipt_delivery.receipt_id')->leftJoin('items','items.id','receipt_delivery.item_id')->where('receipt_delivery.id',$delivery_id)->first();
        $items = item_ledger::where('receipt_id',$receipt)->where('item_id',$item)->where('voucher_delivery_id',$delivery_id)->where('description','=','Sale')->get();
        
        foreach($items as $item){
            $item->return_item = DB::table('item_ledger')->select(DB::raw('SUM(sale) as returnitem'))->where('item_id',$item->item_id)->where('receipt_id',$item->receipt_id)->where('voucher_delivery_id',$delivery_id)->where('store',$item->store)->where('description','Return')->first();
            $item->item = DB::table('items')->where('id',$item->item_id)->first();
        }
        
        return view('pages.sale.item_delivered_store.delivered_store_listing',compact('items','delivered_item'));
    }
    public function add_delivery_store_form($receiptId,$itemId,$qty,$deliveryId)
    {
        $stores = stores::all();
        $item = items::find($itemId);
        $check = item_ledger::select(DB::raw('SUM(sale) as total'))->where('receipt_id',$receiptId)->where('item_id',$itemId)->where('voucher_delivery_id',$deliveryId)->where('description','Sale')->first();

        if($check->total >= $qty){
            return redirect()->back()->with('error','All delivered items are added to stores');
        }else{
            return view('pages.sale.item_delivered_store.add_delivery_store_form',compact('stores','item','check'));
        }
        
    }
     public function add_delivery_store(Request $request)
    {
        $item = items::find($request->item);
        if(stock::where('item_id',$request->item)->where('store',$request->store)->first()){
                $stock = stock::where('item_id',$request->item)->where('store',$request->store)->decrement('qty',$request->quantity);
            }
            $stock = stock::where('item_id',$request->item)->where('store',$request->store)->first();
            $ledger = new item_ledger;
            $ledger->item_id = $request->item;
            $ledger->sale = $request->quantity;
            $ledger->receipt_id = $request->receipt;
            $ledger->description = 'Sale';
            $ledger->left      = $stock->qty;
            $ledger->store     = $request->store;
            $ledger->voucher_delivery_id = $request->delivery_id;
            $ledger->save();
        
        return redirect()->to('sale/storelisting/'.$request->receipt.'/'.$request->item.'/'.$request->total_qty.'/'.$request->delivery_id)->with('message','Record Added successfully');
    }

    public function return_item(Request $request){
        $item = items::find($request->item_id);
        $receiving = DB::table('receipt_delivery')->where('id',$request->delivery_id)->decrement('qty',$request->quantity);
        DB::table('stock')->where('item_id',$request->item_id)->where('store',$request->store)->increment('qty',$request->quantity); 
        $stock = stock::where('item_id',$request->item_id)->where('store',$request->store)->first();
        $ledger = new item_ledger;
        $ledger->item_id = $request->item_id;
        $ledger->purchase = $request->quantity;
        $ledger->receipt_id = $request->receipt_id;
        $ledger->description = 'Return';
        $ledger->left     = $stock->qty;
        $ledger->store     = $request->store;
        $ledger->voucher_delivery_id = $request->delivery_id;
        $ledger->parent_id = $request->parent_id;
        $ledger->save();

        $voucher_detail = new receipt_detail;
        $voucher_detail->receipt_id = $request->receipt_id;
        $voucher_detail->item_id = $request->item_id;
        $voucher_detail->qty = $request->quantity;
        $voucher_detail->sale_price = $item->sale_price;
        $voucher_detail->type = "return";
        $voucher_detail->save();
        
        $voucher = receipt::find($request->receipt_id);
        $voucher->return_amount +=  $item->purchase_price * (($item->meter / $item->pieces) * $request->quantity);
        $voucher->save();

        $vouch = receipt::find($request->receipt_id);
        $sup_bal = DB::table('receipt_ledger')->select(DB::raw('SUM(credit) - SUM(debit) as balance'))->where('receipt_id',$request->receipt_id)->first();
        $voucher_history = new receipt_ledger;
        $voucher_history->receipt_id = $request->receipt_id;
        $voucher_history->credit = $item->purchase_price * (($item->meter / $item->pieces) * $request->quantity);
        $voucher_history->balance = $sup_bal->balance - ($item->purchase_price * (($item->meter / $item->pieces) * $request->quantity));
        $voucher_history->type = "SR";
        $voucher_history->save();
        
        $voucher_history = new customer_ledger;
        $voucher_history->customer_id = $vouch->customer_id;
        $voucher_history->credit = $item->purchase_price * (($item->meter / $item->pieces) * $request->quantity);
        $voucher_history->balance = $sup_bal->balance - ($item->purchase_price * (($item->meter / $item->pieces) * $request->quantity));
        $voucher_history->type = "SR";
        $voucher_history->save();
        return json_encode(['message'=>'successfully']);
    }

}

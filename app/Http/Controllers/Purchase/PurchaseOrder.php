<?php

namespace App\Http\Controllers\Purchase;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\voucher;
use App\suppliers;
use App\items;
use App\voucher_detail;
use App\stock;
use App\item_ledger;
use App\supplier_ledger;
use DB;

class PurchaseOrder extends Controller
{
   /*
    *
    *Voucher Listing Page 
    *
    */
    public function voucher_listing(){
        $vouchers = voucher::all();
    	return view('pages.purchase.voucher_listing',compact('vouchers'));
    }

    /*
    *
    *Add voucher Form 
    *
    */
    public function add_voucher_form(){
    	$suppliers = suppliers::all();
    	$items     = items::all();
    	return view('pages.purchase.add_voucher_form',compact('suppliers','items'));
    }

    /*
    *
    *Add voucher to Database 
    *
    */
    public function addvoucher(Request $request){
    	$voucher = new voucher;
    	$voucher->voucher_no = $request->vendor_voucher;
    	$voucher->supplier_id = $request->supplier;
    	$voucher->voucher_date = $request->voucher_date;
    	$voucher->save();
    	return json_encode($voucher);
    }
    /*
    *
    *search voucher to Database 
    *
    */
    public function searchvoucher(Request $request){
    	$voucher = voucher::where('voucher_no',$request->voucher)->first();
    	return json_encode($voucher);
    }
    /*
    *
    *search barcode from items table and get item 
    *
    */
    public function searchbarcode(Request $request){
    	$item = items::where('barcode',$request->barcode)->first();

        $exsist = voucher_detail::where('item_id',$item->id)->where('voucher_id',$request->voucher_id)->get();
        if(sizeof($exsist) > 0){
            return json_encode(["message"=>"item already added"]);
        }else{
        	return json_encode($item);
        }
    } 
    /*
    *
    *add item voucher details table 
    *
    */
    public function additem(Request $request){
        $check = voucher_detail::where('voucher_id',$request->voucherId)->where('item_id',$request->itemId)->first();
        if($check === null){
            $item = new voucher_detail;
            $item->voucher_id = $request->voucherId;
            $item->item_id = $request->itemId;
            $item->qty = $request->quantity;
            $item->type = $request->type;
            $item->save();
            if(stock::where('item_id',$request->itemId)->first()){
                $stock = stock::where('item_id',$request->itemId)->increment('qty',$request->quantity);
            }else{
                $stock = new stock;
                $stock->item_id = $item->item_id;
                $stock->qty = $item->qty;
                $stock->save();
            }
            $stock = stock::where('item_id',$request->itemId)->first();
            $ledger = new item_ledger;
            $ledger->item_id = $request->itemId;
            $ledger->purchase = $request->quantity;
            $ledger->voucher_id = $request->voucherId;
            $ledger->description = 'Purchase';
            $ledger->left     = $stock->qty;
            $ledger->save();
        }
    	
    	
        
    	$items = voucher_detail::with('item')->where('voucher_id',$item->voucher_id)->get();
    	return json_encode($items);
    }
    /*
    *
    *save voucher total amount to voucher table 
    *
    */
    public function savevoucher(Request $request){
    	$total = DB::table('voucher_detail')->leftJoin('items','voucher_detail.item_id','=','items.id')->select(DB::raw('SUM(items.purchase_price * voucher_detail.qty) as totalPrice'))->where('voucher_detail.voucher_id',$request->voucherId)->where('type','=','purchase')->first();
    	DB::table('voucher')->where('id',$request->voucherId)->update(['total_amount'=>$total->totalPrice]);
        $supplier = new supplier_ledger;
        $supplier->voucher_id = $request->voucherId;
        $supplier->debit = $total->totalPrice;
        $supplier->save();
    	return json_encode($total);
    }
    /*
    *
    *remove item from voucher details table 
    *
    */
    public function removeitem(Request $request){
    	$delete = voucher_detail::where('voucher_id',$request->voucherId)->where('item_id',$request->itemId)->delete();
    	stock::where('item_id',$request->itemId)->decrement('qty',$request->qty);
    	$items = voucher_detail::with('item')->where('voucher_id',$request->voucherId)->get();
    	if(sizeof($items) > 0){
    		return json_encode($items);
    	}else{
    		return json_encode(["message"=>"empty"]);
    	}
    	
    }

    public function editvoucher($voucherId){
        $voucher = voucher::find($voucherId);
        $purchase_items = voucher_detail::with('item')->where('voucher_id',$voucherId)->where('type','=','purchase')->get();
        $return_items = voucher_detail::with('item')->where('voucher_id',$voucherId)->where('type','=','return')->get();
        $items     = items::all();
        return view('pages.purchase.edit_voucher_form',compact('voucher','purchase_items','return_items','items','voucherId'));
    }
    public function returnitem(Request $request){
        try{
            $item = new voucher_detail;
            $item->voucher_id = $request->voucher_id;
            $item->item_id = $request->item_id;
            $item->qty = $request->quantity;
            $item->type = 'return';
            $item->save();
            stock::where('item_id',$request->item_id)->decrement('qty',$request->quantity);
            $stock = stock::where('item_id',$request->item_id)->first();
            $ledger = new item_ledger;
            $ledger->item_id = $request->item_id;
            $ledger->voucher_id = $request->voucherId;
            $ledger->description = 'Return';
            $ledger->sale = $request->quantity;
            $ledger->left     = $stock->qty;
            $ledger->save();
            $total = DB::table('voucher_detail')->leftJoin('items','voucher_detail.item_id','=','items.id')->select(DB::raw('SUM(items.purchase_price * voucher_detail.qty) as totalPrice'))->where('voucher_detail.voucher_id',$request->voucher_id)->where('type','=','return')->first();
            DB::table('voucher')->where('id',$request->voucher_id)->update(['return_amount'=>$total->totalPrice]);
            $supplier = new supplier_ledger;
            $supplier->voucher_id = $request->voucher_id;
            $supplier->credit = $total->totalPrice;
            $supplier->save();
            return 1;
        }catch(Exeption $e){
            dd($e->message);
        }
        

    }

}

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
use App\supplier_history;
use App\cash;
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
    	$items = voucher_detail::with('item')->where('voucher_id',$item->voucher_id)->where('type','purchase')->get();
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
        $supplier->credit = $total->totalPrice;
        $supplier->balance = $total->totalPrice;
        $supplier->type = "P";
        $supplier->save();
        $sup = DB::table('voucher')->select('supplier_id')->where('id',$request->voucherId)->first();
        $sup_bal = DB::table('supplier_history')->select(DB::raw('SUM(credit) - SUM(debit) as balance'))->where('supplier_id',$sup->supplier_id)->first();

        $supplier_history = new supplier_history;
        $supplier_history->supplier_id = $sup->supplier_id;
        $supplier_history->credit = $total->totalPrice;
        $supplier_history->balance = ($sup_bal->balance != null)? $sup_bal->balance + $total->totalPrice:$total->totalPrice;
        $supplier_history->type = "P";
        $supplier_history->save();
    	return json_encode($total);
    }
    /*
    *
    *update voucher total amount and return amount to voucher table 
    *
    */
    public function updatevoucher(Request $request){
        $total = DB::table('voucher_detail')->leftJoin('items','voucher_detail.item_id','=','items.id')->select(DB::raw('SUM(items.purchase_price * voucher_detail.qty) as totalPrice'))->where('voucher_detail.voucher_id',$request->voucherId)->where('type','=','purchase')->first();
        $return = DB::table('voucher_detail')->leftJoin('items','voucher_detail.item_id','=','items.id')->select(DB::raw('SUM(items.purchase_price * voucher_detail.qty) as totalPrice'))->where('voucher_detail.voucher_id',$request->voucherId)->where('type','=','return')->first();
        DB::table('voucher')->where('id',$request->voucherId)->update(['total_amount'=>$total->totalPrice,'return_amount' => $return->totalPrice]);
        return json_encode($total);
    }
    /*
    *
    *remove item from voucher details table 
    *
    */
    public function removeitem(Request $request){
    	$delete = voucher_detail::where('id',$request->id)->delete();
    	stock::where('item_id',$request->itemId)->decrement('qty',$request->qty);
    	$items = voucher_detail::with('item')->where('voucher_id',$request->voucherId)->where('type','purchase')->get();
    	if(sizeof($items) > 0){
    		return json_encode($items);
    	}else{
    		return json_encode(["message"=>"empty"]);
    	}
    } 
    /*
    *
    *remove item from voucher details table 
    *
    */
    public function removereturnitem(Request $request){
        $delete = voucher_detail::where('id',$request->id)->delete();
        stock::where('item_id',$request->itemId)->decrement('qty',$request->qty);
        $items = voucher_detail::with('item')->where('voucher_id',$request->voucherId)->where('type','return')->get();
        if(sizeof($items) > 0){
            return json_encode($items);
        }else{
            return json_encode(["message"=>"empty"]);
        }
    }

    public function editvoucher($voucherId){
        $voucher = voucher::find($voucherId);
        $supplier = suppliers::where('id',$voucher->supplier_id)->first();
        $purchase_items = voucher_detail::with('item')->where('voucher_id',$voucherId)->where('type','=','purchase')->get();
        $return_items = voucher_detail::with('item')->where('voucher_id',$voucherId)->where('type','=','return')->get();
        $items     = items::all();
        return view('pages.purchase.edit_voucher_form',compact('voucher','purchase_items','return_items','items','voucherId','supplier'));
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
            $ledger->voucher_id = $request->voucher_id;
            $ledger->description = 'Purchase Return';
            $ledger->sale = $request->quantity;
            $ledger->left     = $stock->qty;
            $ledger->save();
            $total = DB::table('voucher_detail')->leftJoin('items','voucher_detail.item_id','=','items.id')->select(DB::raw('SUM(items.purchase_price * voucher_detail.qty) as totalPrice'))->where('voucher_detail.voucher_id',$request->voucher_id)->where('type','=','return')->first();
            DB::table('voucher')->where('id',$request->voucher_id)->update(['return_amount'=>$total->totalPrice]);
            $credit = DB::table('items')->select(DB::raw('purchase_price *'.$request->quantity.' as creditbal'))->where('id',$request->item_id)->first();
            $bal = DB::table('voucher')->select(DB::raw('total_amount - return_amount - paid_amount as balance'))->where('id',$request->voucher_id)->first();
            $supplier = new supplier_ledger;
            $supplier->voucher_id = $request->voucher_id;
            $supplier->debit = $credit->creditbal;
            $supplier->balance = $bal->balance;
            $supplier->type = "PR";
            $supplier->save();
            $sup = DB::table('voucher')->select('supplier_id')->where('id',$request->voucher_id)->first();
            $sup_bal = DB::table('supplier_history')->select(DB::raw('SUM(credit) - SUM(debit) as balance'))->where('supplier_id',$sup->supplier_id)->first();
            $supplier_history = new supplier_history;
            $supplier_history->supplier_id = $sup->supplier_id;
            $supplier_history->debit = $credit->creditbal;
            $supplier_history->balance = $sup_bal->balance - $credit->creditbal;
            $supplier_history->type = "PR";
            $supplier_history->save();
            $cash_bal = DB::table('cash')->select(DB::raw('SUM(credit) - SUM(debit) as balance'))->first();
            $cash = new cash;
            $cash->debit = $total->totalPrice;
            $cash->balance = ($cash_bal->balance != null)? $cash_bal->balance + $request->amount:$request->amount;
            $cash->event = 'PR';
            $cash->save();
            $returnItems = voucher_detail::with('item')->where('voucher_id',$request->voucher_id)->where('type','return')->get();
            return json_encode($returnItems);
        }catch(Exeption $e){
            dd($e->message);
        }
    }

}

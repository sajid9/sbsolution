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
use App\stores;
use DB;
use CH;
class PurchaseOrder extends Controller
{
   /*
    *
    *Voucher Listing Page 
    *
    */
    public function voucher_listing(){
        $id = CH::getId();
        $vouchers = voucher::where('user_id',$id)->get();
    	return view('pages.purchase.voucher_listing',compact('vouchers'));
    }

    /*
    *
    *Add voucher Form 
    *
    */
    public function add_voucher_form(){
        $id = CH::getId();
    	$suppliers = suppliers::where('user_id',$id)->get();
    	$items     = items::where('user_id',$id)->get();
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
        $voucher->user_id = CH::getId();
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
    	$item = items::where('barcode',$request->barcode)->get();
        $exsist = [];
        if(sizeof($item) > 0){
            $exsist = voucher_detail::where('item_id',$item[0]->id)->where('voucher_id',$request->voucher_id)->get();
        }
        
        if(sizeof($exsist) > 0){
            return json_encode(["message"=>"item already added"]);
        }else if(sizeof($item) > 0){
        	return json_encode($item[0]);
        }else{
            return json_encode(["message"=>"not found"]);
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
            if($request->pieces != ''){
                $quantity = $request->quantity * $request->pieces;
            }else{
                $quantity = $request->quantity;
            }
            $item = new voucher_detail;
            $item->voucher_id = $request->voucherId;
            $item->item_id = $request->itemId;
            $item->qty = $quantity;
            $item->type = $request->type;
            $item->purchase_price = $request->purchasePrice;
            $item->save();
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

        $total = 0;
        $checkitem = DB::table('voucher_detail')->leftJoin('items','voucher_detail.item_id','=','items.id')->where('voucher_detail.voucher_id',$request->voucherId)->where('voucher_detail.type','=','purchase')->get();
        foreach ($checkitem as $item) {
           
            if($item->type == 'tile'){
                $totalprice = DB::table('voucher_detail')->leftJoin('items','voucher_detail.item_id','=','items.id')->select(DB::raw('items.purchase_price * ((voucher_detail.qty / items.pieces) * items.meter) as totalPrice'))->where('voucher_detail.voucher_id',$request->voucherId)->where('voucher_detail.type','=','purchase')->where('voucher_detail.item_id','=',$item->item_id)->first();
                $total += $totalprice->totalPrice;
            }else{
                $totalprice = DB::table('voucher_detail')->leftJoin('items','voucher_detail.item_id','=','items.id')->select(DB::raw('items.purchase_price * voucher_detail.qty as totalPrice'))->where('voucher_detail.voucher_id',$request->voucherId)->where('voucher_detail.type','=','purchase')->where('voucher_detail.item_id','=',$item->item_id)->first();
                $total += $totalprice->totalPrice;
            }
            if(env("BYPARTS_RECEIVING") == 'no')
            {
                $quantity = ($item->type == 'tile')? $request->quantity * $item->pieces : $item->qty;
                if(stock::where('item_id',$item->item_id)->where('store',1)->first()){
                    $stock = stock::where('item_id',$item->item_id)->where('store',1)->increment('qty',$quantity);
                }else{
                    $stock = new stock;
                    $stock->item_id = $item->item_id;
                    $stock->qty = $quantity;
                    $stock->store = 1;
                    $stock->save();
                }
                $stock = stock::where('item_id',$item->item_id)->first();
                $ledger              = new item_ledger;
                $ledger->item_id     = $item->item_id;
                $ledger->purchase    = $item->qty;
                $ledger->voucher_id  = $request->voucherId;
                $ledger->description = 'Purchase';
                $ledger->left        = $stock->qty;
                $ledger->store       = 1;
                $ledger->save();
            }
        }
    	
    	DB::table('voucher')->where('id',$request->voucherId)->update(['total_amount'=>$total]);
        $sup = DB::table('voucher')->select('supplier_id')->where('id',$request->voucherId)->first();
        $sup_bal = DB::table('supplier_history')->select(DB::raw('SUM(credit) - SUM(debit) as balance'))->where('supplier_id',$sup->supplier_id)->first();

        $supplier = new supplier_ledger;
        $supplier->voucher_id = $request->voucherId;
        $supplier->supplier_id = $sup->supplier_id;
        $supplier->credit = $total;
        $supplier->balance = $total;
        $supplier->type = "P";
        $supplier->save();
        
        $supplier_history = new supplier_history;
        $supplier_history->supplier_id = $sup->supplier_id;
        $supplier_history->voucher_id = $request->voucherId;
        $supplier_history->credit = $total;
        $supplier_history->balance = ($sup_bal->balance != null)? $sup_bal->balance + $total:$total;
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
        $total = 0;
        $checkitem = DB::table('voucher_detail')->leftJoin('items','voucher_detail.item_id','=','items.id')->where('voucher_detail.voucher_id',$request->voucherId)->where('voucher_detail.type','=','purchase')->get();
        foreach ($checkitem as $item) {
           
            if($item->type == 'tile'){
                $totalprice = DB::table('voucher_detail')->leftJoin('items','voucher_detail.item_id','=','items.id')->select(DB::raw('items.purchase_price * ((voucher_detail.qty / items.pieces) * items.meter) as totalPrice'))->where('voucher_detail.voucher_id',$request->voucherId)->where('voucher_detail.type','=','purchase')->where('voucher_detail.item_id','=',$item->item_id)->first();
                $total += $totalprice->totalPrice;
            }else{
                $totalprice = DB::table('voucher_detail')->leftJoin('items','voucher_detail.item_id','=','items.id')->select(DB::raw('items.purchase_price * voucher_detail.qty as totalPrice'))->where('voucher_detail.voucher_id',$request->voucherId)->where('voucher_detail.type','=','purchase')->where('voucher_detail.item_id','=',$item->item_id)->first();
                $total += $totalprice->totalPrice;
            }
        }
        $return = DB::table('voucher_detail')->leftJoin('items','voucher_detail.item_id','=','items.id')->select(DB::raw('SUM(items.purchase_price * voucher_detail.qty) as totalPrice'))->where('voucher_detail.voucher_id',$request->voucherId)->where('voucher_detail.type','=','return')->first();
        if($return->totalPrice == null){
            $return->totalPrice = 0;
        }
        DB::table('voucher')->where('id',$request->voucherId)->update(['total_amount'=>$total,'return_amount' => $return->totalPrice]);
        return json_encode(['total' => $total]);
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
            $item->purchase_price = $request->purchase_price;
            $item->store_id = 1;
            $item->type = 'return';
            $item->save();
            stock::where('item_id',$request->item_id)->where('store',1)->decrement('qty',$request->quantity);
            $stock = stock::where('item_id',$request->item_id)->where('store',1)->first();
            $ledger = new item_ledger;
            $ledger->item_id = $request->item_id;
            $ledger->voucher_id = $request->voucher_id;
            $ledger->description = 'Purchase Return';
            $ledger->sale = $request->quantity;
            $ledger->left     = $stock->qty;
            $ledger->store    = 1;
            $ledger->save();
            $total = DB::table('voucher_detail')->leftJoin('items','voucher_detail.item_id','=','items.id')->select(DB::raw('SUM(items.purchase_price * voucher_detail.qty) as totalPrice'))->where('voucher_detail.voucher_id',$request->voucher_id)->where('voucher_detail.type','=','return')->first();
            DB::table('voucher')->where('id',$request->voucher_id)->update(['return_amount'=>$total->totalPrice]);
            $credit = DB::table('items')->select(DB::raw('purchase_price *'.$request->quantity.' as creditbal'))->where('id',$request->item_id)->first();
            $bal = DB::table('voucher')->select(DB::raw('total_amount - return_amount - paid_amount as balance'))->where('id',$request->voucher_id)->first();
            $sup = DB::table('voucher')->select('supplier_id')->where('id',$request->voucher_id)->first();
            $supplier = new supplier_ledger;
            $supplier->voucher_id = $request->voucher_id;
            $supplier->supplier_id = $sup->supplier_id;
            $supplier->debit = $credit->creditbal;
            $supplier->balance = $bal->balance;
            $supplier->type = "PR";
            $supplier->save();
            $sup_bal = DB::table('supplier_history')->select(DB::raw('SUM(credit) - SUM(debit) as balance'))->where('supplier_id',$sup->supplier_id)->first();
            $supplier_history = new supplier_history;
            $supplier_history->supplier_id = $sup->supplier_id;
            $supplier_history->voucher_id = $request->voucher_id;
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
            return json_encode(['message'=>'successfully']);
        }catch(Exeption $e){
            dd($e->message);
        }
    }
    public function selectsupplier(Request $request)
    {
        $voucher = voucher::find($request->id);
        $supplier = suppliers::find($voucher->supplier_id);
        return json_encode(['supplier' => $supplier,'voucher'=> $voucher]);
    }
    public function direct_in()
    {
        $id = CH::getId();
        $items  = items::where('user_id',$id)->get();
        $stores = stores::where('user_id',$id)->get(); 
        return view('pages.purchase.direct_in',compact('items','stores'));
    }
    public function save_item(Request $request){
        $request->validate([
            'store' =>'required'
        ]);
        
        if(stock::where('item_id',$request->item_id)->where('store',$request->store)->first()){
            $stock = stock::where('item_id',$request->item_id)->where('store',$request->store)->increment('qty',$request->quantity);
        }else{
            $stock = new stock;
            $stock->item_id = $request->item_id;
            $stock->qty = $request->quantity;
            $stock->store = $request->store;
            $stock->save();
        }
        $stock = stock::where('item_id',$request->item_id)->where('store',$request->store)->first();
        $ledger = new item_ledger;
        $ledger->item_id = $request->item_id;
        $ledger->purchase = $request->quantity;
        $ledger->description = 'Direct In';
        $ledger->left     = $stock->qty;
        $ledger->store    = $request->store;
        $ledger->save();
        return redirect()->to('voucher/directin')->with('message','Item Added Successfully');
    }
    public function get_returned_total(Request $request)
    {
        $return = item_ledger::select(DB::raw('SUM(sale) as total'))->where('voucher_id',$request->voucher)->where('item_id',$request->item)->where('description','=','Purchase Return')->first();
        return json_encode($return);
    }

}

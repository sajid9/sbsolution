<?php

namespace App\Http\Controllers\sale;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\receipt;
use App\items;
use App\customers;
use App\receipt_detail;
use App\stock;
use App\item_ledger;
use App\customer_ledger;
use App\receipt_ledger;
use App\cash;
use DB;
class saleorder extends Controller
{
    public function salelisting(){
    	$receipts = receipt::all();
    	return view('pages.sale.sale_listing',compact('receipts'));
    }
    public function receiptform(){
    	$customers = customers::all();
    	$items     = items::all();
    	return view('pages.sale.add_receipt_form',compact('items','customers'));
    }
    public function addreceipt(Request $request){
    	$receipt = new receipt;
    	$receipt->receipt_no = $request->receipt_number;
    	$receipt->customer_id = $request->customer;
    	$receipt->receipt_date = $request->receipt_date;
        if($request->has('type')){
            $receipt->type    = $request->type;
        }else{
            $receipt->type    = 'sale';
        }
    	$receipt->save();
    	return json_encode($receipt);
    }
    /*
    *
    *add item voucher details table 
    *
    */
    public function additem(Request $request){
        $check = receipt_detail::where('receipt_id',$request->receipt_id)->where('item_id',$request->itemId)->first();
        if($check === null){
            $item = new receipt_detail;
            $item->receipt_id = $request->receipt_id;
            $item->item_id = $request->itemId;
            $item->sale_price = $request->sale_price;
            $item->discount = $request->discounted_price;
            $item->total_price = $request->total_price;
            $item->qty = $request->quantity;
            $item->type = $request->type;
            $item->save();
        }
        
    	$items = receipt_detail::with('item')->where('receipt_id',$request->receipt_id)->where('type','sale')->get();
    	return json_encode($items);
    }
    /*
    *
    *save voucher total amount to voucher table 
    *
    */
    public function savereceipt(Request $request){
    	$total = DB::table('receipt_detail')->select(DB::raw('SUM(discount) as totalPrice'))->where('receipt_detail.receipt_id',$request->receipt_id)->where('type','=','sale')->first();
    	$receipt = DB::table('receipt')->where('id',$request->receipt_id)->update(['total_amount'=>$total->totalPrice]);
        if($request->check !== 'quotation'){
            $receipt = new receipt_ledger;
            $receipt->receipt_id = $request->receipt_id;
            $receipt->debit = $total->totalPrice;
            $receipt->balance = $total->totalPrice;
            $receipt->type = "S";
            $receipt->save();
            $sup = DB::table('receipt')->where('id',$request->receipt_id)->first();
            $sup_bal = DB::table('customer_ledger')->select(DB::raw('SUM(debit) - SUM(credit) as balance'))->where('customer_id',$sup->customer_id)->first();

            $customer_history = new customer_ledger;
            $customer_history->customer_id = $sup->customer_id;
            $customer_history->debit = $total->totalPrice;
            $customer_history->balance = ($sup_bal->balance != null)? $sup_bal->balance + $total->totalPrice:$total->totalPrice;
            $customer_history->type = "S";
            $customer_history->save();
        }else{
            $sup = DB::table('receipt')->where('id',$request->receipt_id)->first();
        }
        
    	return json_encode($sup);
    }
    public function editreceipt($receiptId){
        $receipt = receipt::find($receiptId);
        $customer = customers::where('id',$receipt->customer_id)->first();
        $purchase_items = receipt_detail::with('item')->where('receipt_id',$receiptId)->where('type','=','sale')->get();
        $return_items = receipt_detail::with('item')->where('receipt_id',$receiptId)->where('type','=','return')->get();
        $items     = items::all();
        return view('pages.sale.edit_receipt_form',compact('receipt','purchase_items','return_items','items','receiptId','customer'));
    }

    public function returnitem(Request $request){
        try{
            /*calculate the discount and total price of returned items*/
            $one_piece_price = $request->total_price / $request->total_quantity;
            $price = $one_piece_price * $request->quantity;
            $one_piece_discount = $request->discount / $request->total_quantity;
            $discount = $one_piece_discount * $request->quantity;
            
            $item = new receipt_detail;
            $item->receipt_id  = $request->receipt_id;
            $item->item_id     = $request->item_id;
            $item->qty         = $request->quantity;
            $item->sale_price  = $request->sale_price;
            $item->discount    = $discount;
            $item->total_price = $price;
            $item->type        = 'return';
            $item->save();
            stock::where('item_id',$request->item_id)->increment('qty',$request->quantity);
            $stock = stock::where('item_id',$request->item_id)->first();
            $ledger = new item_ledger;
            $ledger->item_id = $request->item_id;
            $ledger->receipt_id = $request->receipt_id;
            $ledger->description = 'Sale Return';
            $ledger->purchase = $request->quantity;
            $ledger->left     = $stock->qty;
            $ledger->save();
            $total = DB::table('receipt_detail')->select(DB::raw('SUM(total_price) as totalPrice'))->where('receipt_id',$request->receipt_id)->where('type','=','return')->first();
            DB::table('receipt')->where('id',$request->receipt_id)->update(['return_amount'=>$total->totalPrice]);
            
            $bal = DB::table('receipt')->select(DB::raw('total_amount - return_amount - paid_amount as balance'))->where('id',$request->receipt_id)->first();
            $receipt = new receipt_ledger;
            $receipt->receipt_id = $request->receipt_id;
            $receipt->credit = $price;
            $receipt->balance = $bal->balance;
            $receipt->type = "SR";
            $receipt->save();
            $sup = DB::table('receipt')->select('customer_id')->where('id',$request->receipt_id)->first();
            $sup_bal = DB::table('customer_ledger')->select(DB::raw('SUM(debit) - SUM(credit) as balance'))->where('customer_id',$sup->customer_id)->first();
            $customer = new customer_ledger;
            $customer->customer_id = $sup->customer_id;
            $customer->credit = $price;
            $customer->balance = $sup_bal->balance - $price;
            $customer->type = "SR";
            $customer->save();
            $cash_bal = DB::table('cash')->select(DB::raw('SUM(debit) - SUM(credit) as balance'))->first();
            
            $returnItems = receipt_detail::with('item')->where('receipt_id',$request->receipt_id)->where('type','return')->get();
            return json_encode($returnItems);
        }catch(Exeption $e){
            dd($e->message);
        }
    }
    public function updatereceipt(Request $request){
        $total = DB::table('receipt_detail')->select(DB::raw('SUM(total_price) as totalPrice'))->where('receipt_detail.receipt_id',$request->receiptId)->where('type','=','sale')->first();
        $return = DB::table('receipt_detail')->select(DB::raw('SUM(total_price) as totalPrice'))->where('receipt_detail.receipt_id',$request->receiptId)->where('type','=','return')->first();
        if($return->totalPrice === null){
            $return->totalPrice = 0;
        }
        DB::table('receipt')->where('id',$request->receiptId)->update(['total_amount'=>$total->totalPrice,'return_amount' => $return->totalPrice]);
        if($request->check !== 'quotation'){
            $ledger = DB::table('receipt_ledger')->where('receipt_id',$request->receiptId)->where('type','S')->get();
            if(sizeof($ledger) == 0){
                $receipt = new receipt_ledger;
                $receipt->receipt_id = $request->receiptId;
                $receipt->debit = $total->totalPrice;
                $receipt->balance = $total->totalPrice;
                $receipt->type = "S";
                $receipt->save();
                $sup = DB::table('receipt')->where('id',$request->receiptId)->first();
                $sup_bal = DB::table('customer_ledger')->select(DB::raw('SUM(debit) - SUM(credit) as balance'))->where('customer_id',$sup->customer_id)->first();

                $customer_history = new customer_ledger;
                $customer_history->customer_id = $sup->customer_id;
                $customer_history->debit = $total->totalPrice;
                $customer_history->balance = ($sup_bal->balance != null)? $sup_bal->balance + $total->totalPrice:$total->totalPrice;
                $customer_history->type = "S";
                $customer_history->save();
                $items = DB::table('receipt_detail')->where('receipt_id',$request->receiptId)->get();
                foreach ($items as $item) {
                   $stock = stock::where('item_id',$item->item_id)->decrement('qty',$item->qty);
                   $stock = stock::where('item_id',$item->item_id)->first();
                   $ledger = new item_ledger;
                   $ledger->item_id = $item->item_id;
                   $ledger->sale = $item->qty;
                   $ledger->receipt_id = $item->receipt_id;
                   $ledger->description = 'Sale';
                   $ledger->left     = $stock->qty;
                   $ledger->save();
                }
                
            }
        }
        return json_encode($total);
    }
    public function searchbarcode(Request $request){
        $item = items::where('barcode',$request->barcode)->first();

        $exsist = receipt_detail::where('item_id',$item->id)->where('receipt_id',$request->receipt_id)->get();
        if(sizeof($exsist) > 0){
            return json_encode(["message"=>"item already added"]);
        }else{
            return json_encode($item);
        }
    }
    public function selectcustomer(Request $request)
    {
        $receipt = receipt::find($request->id);
        $customer = customers::find($receipt->customer_id);
        return json_encode(['customer' => $customer,'receipt'=> $receipt]);
    }
}

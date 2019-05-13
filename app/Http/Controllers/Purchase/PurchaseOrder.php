<?php

namespace App\Http\Controllers\Purchase;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\voucher;
use App\suppliers;
use App\items;
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
}

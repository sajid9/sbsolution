<?php

namespace App\Http\Controllers\Taxes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\tax;
use CH;
class TaxController extends Controller
{
    public function tax_listing()
    {
    	$id = CH::getId();
    	$taxes = tax::where('user_id',$id)->get();
    	return view('pages.taxes.tax_listing',compact('taxes'));
    }
    public function add_form()
    {
    	return view('pages.taxes.add_tax_form');
    }
    public function add_tax(Request $request)
    {
        $id = CH::getId();
    	$tax = new tax;
    	$tax->name = $request->name;
    	$tax->price = $request->price;
    	if($request->has('is_active')){
		    $tax->is_active    = $request->is_active;
		}else{
		    $tax->is_active    = 'no';
		}
        $tax->user_id = $id;
		$tax->save();
		return redirect()->to('tax/taxlisting')->with('message','Tax added successfully');
    }
    public function edit_tax($id)
    {
    	$tax = tax::find($id);
    	return view('pages.taxes.edit_tax_form',compact('tax'));
    }
    public function update_tax(Request $request)
    {
        $id = CH::getId();
    	$tax = tax::find($request->id);
    	$tax->name = $request->name;
    	$tax->price = $request->price;
    	if($request->has('is_active')){
		    $tax->is_active    = $request->is_active;
		}else{
		    $tax->is_active    = 'no';
		}
        $tax->user_id = $id;
		$tax->save();
		return redirect()->to('tax/taxlisting')->with('message','Tax updated successfully');
    }
}

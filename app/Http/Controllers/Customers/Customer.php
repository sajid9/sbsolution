<?php

namespace App\Http\Controllers\Customers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\customers;
use App\Http\Requests\customerValidator;
class Customer extends Controller
{
    /*
    *
    *Customer Listing Page 
    *
    */
    public function customer_listing(){
        $customers = customers::all();
    	return view('pages.customers.customer_listing',compact('customers'));
    }

    /*
    *
    *Add Customer Form 
    *
    */
    public function add_customer_form(){
    	return view('pages.customers.add_customer_form');
    }

    /*
    *
    *Add Customer To DataBase
    * 
    */
    public function addcustomer(customerValidator $request){
    	
    	try{
			$request->validated();

			$customer = new customers;

		    $customer->customer_name = $request->customer_name;
		    $customer->email         = $request->email;
		    $customer->phone         = $request->phone;
		    $customer->mobile        = $request->mobile;
		    $customer->cnic          = $request->cnic;
		    $customer->website       = $request->website;
		    $customer->address       = $request->address;
		    $customer->occupation    = $request->occupation;
		    $customer->gst           = $request->gst;
		    $customer->ntn           = $request->ntn;

		    $customer->standing_instruction  = $request->standing_instruction;
		    $customer->save();

		    return redirect()->to('customer/customerlisting')->with('message','Customer added successfully.');
    	}catch(\Exception $e){
    		return $e->getMessage();
    	}
    }

    /*
    *
    *Edit Customer Form 
    *
    */
    public function editcustomer($id){
       $customer = customers::find($id);
       return view('pages.customers.edit_customer_form',compact('customer'));
    }

    /*
    *
    *Update Customer To DataBase
    * 
    */

    public function updatecustomer(customerValidator $request){
        try{
            $request->validated();
            $customer = customers::find($request->id);
            $customer->customer_name = $request->customer_name;
		    $customer->email         = $request->email;
		    $customer->phone         = $request->phone;
		    $customer->mobile        = $request->mobile;
		    $customer->cnic          = $request->cnic;
		    $customer->website       = $request->website;
		    $customer->address       = $request->address;
		    $customer->occupation    = $request->occupation;
		    $customer->gst           = $request->gst;
		    $customer->ntn           = $request->ntn;

		    $customer->standing_instruction  = $request->standing_instruction;
		    $customer->save();

            return redirect()->to('customer/customerlisting')->with('message','Customer updated successfully.');
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }

    /*
    *
    *Delete Customer From DataBase 
    *
    */

    public function deletecustomer($id){
        try{
            $customer = customers::find($id);
            $customer->delete();
            return redirect()->to('customer/customerlisting')->with('error','Customer deleted successfully.');
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }

}

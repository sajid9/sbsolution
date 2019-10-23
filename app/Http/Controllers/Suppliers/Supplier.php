<?php

namespace App\Http\Controllers\Suppliers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\supplierValidator;
use App\suppliers;
use CH;
class Supplier extends Controller
{
    /*
    *
    *Supplier Listing Page 
    *
    */
    public function supplier_listing(){
        $id = CH::getId();
        $suppliers = suppliers::where('user_id',$id)->get();
    	return view('pages.suppliers.supplier_listing',compact('suppliers'));
    }

    /*
    *
    *Add Supplier Form 
    *
    */
    public function add_supplier_form(){
    	return view('pages.suppliers.add_supplier_form');
    }

    /*
    *
    *Add Supplier To DataBase
    * 
    */
    public function addsupplier(supplierValidator $request){
    	
    	try{
			$request->validated();

			$supplier = new suppliers;

		    $supplier->supplier_name = $request->supplier_name;
		    $supplier->email         = $request->email;
		    $supplier->phone         = $request->phone;
		    $supplier->mobile        = $request->mobile;
		    $supplier->cnic          = $request->cnic;
		    $supplier->website       = $request->website;
		    $supplier->address       = $request->address;
            $supplier->user_id       = CH::getId();
		    $supplier->save();

		    return redirect()->to('supplier/supplierlisting')->with('message','Supplier added successfully.');
    	}catch(\Exception $e){
    		return $e->getMessage();
    	}
    }

    /*
    *
    *Edit Supplier Form 
    *
    */
    public function editsupplier($id){
       $supplier = suppliers::find($id);
       return view('pages.suppliers.edit_supplier_form',compact('supplier'));
    }

    /*
    *
    *Update Supplier To DataBase
    * 
    */

    public function updatesupplier(supplierValidator $request){
        try{
            $request->validated();
            $supplier = suppliers::find($request->id);
            $supplier->supplier_name = $request->supplier_name;
		    $supplier->email         = $request->email;
		    $supplier->phone         = $request->phone;
		    $supplier->mobile        = $request->mobile;
		    $supplier->cnic          = $request->cnic;
		    $supplier->website       = $request->website;
		    $supplier->address       = $request->address;
		    $supplier->save();

            return redirect()->to('supplier/supplierlisting')->with('message','Supplier updated successfully.');
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }

    /*
    *
    *Delete Supplier From DataBase 
    *
    */

    public function deletesupplier($id){
        try{
            $supplier = suppliers::find($id);
            $supplier->delete();
            return redirect()->to('supplier/supplierlisting')->with('error','Supplier deleted successfully.');
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }
}

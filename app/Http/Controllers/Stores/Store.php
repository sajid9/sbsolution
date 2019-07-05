<?php

namespace App\Http\Controllers\Stores;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\stores;
class Store extends Controller
{
    public function store_listing(){
    	$stores = stores::all();
    	return view('pages.stores.store_listing',compact('stores'));
    }
    public function add_store_form(){
    	return view('pages.stores.add_store_form');
    }
    public function add_store(Request $request){
    	$store = new stores;
    	$store->name = $request->store_name;
    	$store->address = $request->address;
    	if($request->has('is_active')){
		    $store->is_active    = $request->is_active;
		}else{
		    $store->is_active    = 'no';
		}
    	$store->save();
    	return redirect()->to('store/storelisting')->with('message','Record Added Successfully');
    }
    public function edit_store($id){
    	$store = stores::find($id);
    	return view('pages.stores.edit_store_form',compact('store'));
    }
    public function update_store(Request $request){
    	$store = stores::find($request->id);
    	$store->name = $request->store_name;
    	$store->address = $request->address;
    	if($request->has('is_active')){
		    $store->is_active    = $request->is_active;
		}else{
		    $store->is_active    = 'no';
		}
		$store->save();
		return redirect()->to('store/storelisting')->with('message','Record Updated Successfully');
    }
    public function delete_store($id){
    	$store = stores::find($id);
        $store->delete();
        return redirect()->to('store/storelisting')->with('message','Record Deleted Successfully');
    }
}

<?php

namespace App\Http\Controllers\sizes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\sizes;
class size extends Controller
{
    public function size_listing()
    {
    	$sizes = sizes::all();
    	return view('pages.sizes.size_listing',compact('sizes'));
    }
    public function add_size_form()
    {
    	
    	return view('pages.sizes.add_size_form');
    }
    public function add_size(Request $request)
    {
    	$size = new sizes;
    	$size->size = $request->size;
    	if($request->has('is_active')){
		    $size->is_active    = $request->is_active;
		}else{
		    $size->is_active    = 'no';
		}
		$size->save();
		return redirect()->to('size/sizelisting')->with('message','Record Added Successfully');
    }
    public function edit_size($id='')
    {
    	$size = sizes::find($id);
    	return view('pages.sizes.edit_size_form',compact('size'));
    }
    public function update_size(Request $request)
    {
    	$size = sizes::find($request->id);
    	$size->size = $request->size;
    	if($request->has('is_active')){
		    $size->is_active    = $request->is_active;
		}else{
		    $size->is_active    = 'no';
		}
		$size->save();
		return redirect()->to('size/sizelisting')->with('message','Record Updated Successfully');
    }
}

<?php

namespace App\Http\Controllers\measuring;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\units;
class unit extends Controller
{
    public function unit_listing()
    {
    	$units = units::all();
    	return view('pages.measuring.unit_listing',compact('units'));
    }
    public function add_unit_form()
    {
    	return view('pages.measuring.add_unit_form');
    }
    public function addunit(Request $request)
    {
    	$unit = new units;
    	$unit->unit = $request->unit;
    	if($request->has('is_active')){
		    $unit->is_active    = $request->is_active;
		}else{
		    $unit->is_active    = 'no';
		}
		$unit->save();
    	return redirect()->to('measuring/unitlisting')->with('message','Record Added Successfully');
    }
    public function edit_unit($id = '')
    {
    	$unit = units::find($id);
    	return view('pages.measuring.edit_unit_form',compact('unit'));
    }
    public function update_unit(Request $request)
    {
    	$unit = units::find($request->id);
    	$unit->unit = $request->unit;
    	if($request->has('is_active')){
		    $unit->is_active    = $request->is_active;
		}else{
		    $unit->is_active    = 'no';
		}
		$unit->save();
    	return redirect()->to('measuring/unitlisting')->with('message','Record Updated Successfully');
    }
}

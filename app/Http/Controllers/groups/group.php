<?php

namespace App\Http\Controllers\groups;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\groups;
use CH;
class group extends Controller
{
    public function group_listing()
    {
        $id = CH::getId();
    	$groups = groups::where('user_id',$id)->get();
    	return view('pages.groups.group_listing',compact('groups'));
    }
    public function add_group_form()
    {
    	return view('pages.groups.add_group_form');
    }
    public function add_group(Request $request)
    {
    	$group = new groups;
    	$group->name = $request->group_name;
        $group->user_id = CH::getId();
    	if($request->has('is_active')){
		    $group->is_active    = $request->is_active;
		}else{
		    $group->is_active    = 'no';
		}
		$group->save();
    	return redirect()->to('group/grouplisting')->with('message','Record Added Successfully');
    }

    public function edit_group($id)
    {
    	$group = groups::find($id);
    	return view('pages.groups.edit_group_form',compact('group'));
    }

    public function update_group(Request $request)
    {
    	$group = groups::find($request->id);
    	$group->name = $request->group_name;
    	if($request->has('is_active')){
		    $group->is_active    = $request->is_active;
		}else{
		    $group->is_active    = 'no';
		}
		$group->save();
    	return redirect()->to('group/grouplisting')->with('message','Record Updated Successfully');
    }

}

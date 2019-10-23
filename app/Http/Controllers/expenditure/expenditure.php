<?php

namespace App\Http\Controllers\expenditure;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\head;
use App\subhead;
use App\month;
use CH;
class expenditure extends Controller
{
    public function headlisting()
    {
        $id = CH::getId();
    	$heads = head::where('user_id',$id)->get();
    	return view('pages.head.head_listing',compact('heads'));
    }
    public function addhead()
    {
    	return view('pages.head.add_head_form');
    }
    public function savehead(Request $request)
    {
    	$request->validate(['head_name'=>'required']);
    	$head = new head;
    	$head->name = $request->head_name;
        $head->user_id = CH::getId();
    	if($request->has('is_active')){
    		$head->is_active    = $request->is_active;
    	}else{
    		$head->is_active    = 'no';
    	}
    	$head->save();
    	return redirect()->to('expenditure/headlisting')->with('message','Record Added successfully');
    }
    public function edithead($id)
    {
    	$head = head::find($id);
    	return view('pages.head.edit_head_form',compact('head'));
    }
    public function updatehead(Request $request)
    {
    	$request->validate(['head_name'=>'required']);
    	$head = head::find($request->id);
    	$head->name = $request->head_name;
    	if($request->has('is_active')){
    		$head->is_active    = $request->is_active;
    	}else{
    		$head->is_active    = 'no';
    	}
    	$head->save();
    	return redirect()->to('expenditure/headlisting')->with('message','Record Updated Successfully');
    }
    public function subheadlisting($id)
    {
    	$subheads = subhead::where('head_id',$id)->with('head')->get();
    	return view('pages.head.subhead.subhead_listing',compact('subheads'));
    }
    public function addsubhead($id)
    {
    	return view('pages.head.subhead.add_subhead_form',compact('id'));
    }
    public function savesubhead(Request $request)
    {
    	$request->validate(['head_name'=>'required']);
    	$head = new subhead;
    	$head->name = $request->head_name;
    	$head->head_id = $request->parent_id;
    	if($request->has('is_active')){
    		$head->is_active    = $request->is_active;
    	}else{
    		$head->is_active    = 'no';
    	}
    	$head->save();
    	return redirect()->to('expenditure/subheadlisting/'.$request->parent_id)->with('message','Record Added successfully');
    }
    public function editsubhead($id)
    {
    	$subhead = subhead::find($id);
    	return view('pages.head.subhead.edit_subhead_form',compact('subhead'));
    }
    public function updatesubhead(Request $request)
    {
    	$request->validate(['head_name'=>'required']);
    	$head = subhead::find($request->id);
    	$head->name = $request->head_name;
    	if($request->has('is_active')){
    		$head->is_active    = $request->is_active;
    	}else{
    		$head->is_active    = 'no';
    	}
    	$head->save();
    	return redirect()->to('expenditure/subheadlisting/'.$head->head_id)->with('message','Record Updated Successfully');
    }
    public function monthlisting()
    {
        $id = CH::getId();
    	$months = month::where('user_id',$id)->get();
    	return view('pages.month.month_listing',compact('months'));
    }
    public function addmonthform()
    {
    	return view('pages.month.add_month_form');
    }
    public function addmonth(Request $request)
    {
    	$request->validate(['month_name'=>'required']);
    	$month = new month;
    	$month->name = $request->month_name;
        $month->user_id = CH::getId();
    	if($request->has('is_active')){
    		$month->is_active    = $request->is_active;
    	}else{
    		$month->is_active    = 'no';
    	}
    	$month->save();
    	return redirect()->to('expenditure/monthlisting')->with('message','Record Added successfully');
    }
    public function editmonth($id)
    {
    	$month = month::find($id);
    	return view('pages.month.edit_month_form',compact('month'));
    }
    public function updatemonth(Request $request)
    {
    	$request->validate(['month_name'=>'required']);
    	$month = month::find($request->id);
    	$month->name = $request->month_name;
    	if($request->has('is_active')){
    		$month->is_active    = $request->is_active;
    	}else{
    		$month->is_active    = 'no';
    	}
    	$month->save();
    	return redirect()->to('expenditure/monthlisting')->with('message','Record Updated Successfully');
    }
    public function getsubhead(Request $request)
    {
        $subheads = subhead::where('head_id',$request->id)->get();
        return json_encode($subheads);
    }


}

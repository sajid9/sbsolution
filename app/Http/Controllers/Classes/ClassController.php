<?php

namespace App\Http\Controllers\Classes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\classValidator;
use App\classes;
class ClassController extends Controller
{
	/*
	*
	* Classes Listing Page 
	*
	*/
    public function class_listing(){
	    $classes = classes::where('parent_id',0)->get();
		return view('pages.classes.class_listing',compact('classes'));
    }

    /*
	*
	* Add Class Form  
	*
	*/

	public function add_class_form(){
    	return view('pages.classes.add_class_form');
    }

    /*
    *
    *Add Class To DataBase
    * 
    */
    public function addclass(classValidator $request){
    	
    	try{
			$request->validated();

			$class = new classes;

		    $class->class_name = $request->class_name;
		    $class->discount     = $request->discount;
		    $class->description  = $request->description;
		    $class->parent_id  	 = 0;
		    if($request->has('is_active')){
		    	$class->is_active    = $request->is_active;
		    }else{
		    	$class->is_active    = 'no';
		    }
		    $class->save();

		    return redirect()->to('class/classlisting')->with('message','Class added successfully.');
    	}catch(\Exception $e){
    		return $e->getMessage();
    	}
    }

    /*
    *
    *Edit Class Form 
    *
    */
    public function editclass($id){
       $class = classes::find($id);
       return view('pages.classes.edit_class_form',compact('class'));
    }

    /*
    *
    *Update Class To DataBase
    * 
    */

    public function updateclass(Request $request){
        try{
            $request->validate(['class_name'=>'required']);
            $class = Classes::find($request->id);
            $class->class_name = $request->class_name;
            $class->discount     = $request->discount;
            $class->description  = $request->description;
            if($request->has('is_active')){
                $class->is_active    = $request->is_active;
            }else{
                $class->is_active    = 'no';
            }
            $class->save();

            return redirect()->to('class/classlisting')->with('message','Class updated successfully.');
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }
    /*
    *
    *Delete Class From DataBase 
    *
    */

    public function deleteclass($id){
        try{
            $class = classes::find($id);
            $class->delete();
            return redirect()->to('class/classlisting')->with('error','Class deleted successfully.');
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }

}

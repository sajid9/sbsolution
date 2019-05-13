<?php

namespace App\Http\Controllers\Classes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\classes;
use App\Http\Requests\classValidator;
class SubClassController extends Controller
{
	/*
	*
	* Sub Class Listing Page 
	*
	*/
    public function class_listing($id){

	    $classes = classes::where('parent_id',$id)->get();
		return view('pages.classes.subClasses.sub_class_listing',compact('classes'));
    }

    /*
	*
	* Add Sub Class Form  
	*
	*/

	public function add_sub_class_form($id){
    	return view('pages.classes.subClasses.add_class_form',compact('id'));
    }

     /*
    *
    *Add Sub Class To DataBase
    * 
    */
    public function addclass(classValidator $request){
    	
    	try{
			$request->validated();

			$class = new classes;

		    $class->class_name = $request->class_name;
		    $class->discount     = $request->discount;
		    $class->description  = $request->description;
		    $class->parent_id  	 = $request->parent_id;
		    if($request->has('is_active')){
		    	$class->is_active    = $request->is_active;
		    }else{
		    	$class->is_active    = 'no';
		    }
		    $class->save();

		    return redirect()->to('subclass/classlisting/'.$request->parent_id)->with('message','Subclass added successfully.');
    	}catch(\Exception $e){
    		return $e->getMessage();
    	}
    }

     /*
    *
    *Edit Sub Class Form 
    *
    */
    public function editclass($id){
       $class = classes::find($id);
       return view('pages.classes.subClasses.edit_class_form',compact('class'));
    }

    /*
    *
    *Update Sub Class To DataBase
    * 
    */

    public function updateclass(classValidator $request){
        try{
            $request->validated();
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

            return redirect()->to('subclass/classlisting/'.$request->parent_id)->with('message','Subclass updated successfully.');
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }

    /*
    *
    *Delete SubClass From DataBase 
    *
    */

    public function deleteclass($parentId,$id){
        try{
            $class = classes::find($id);
            $class->delete();
            return redirect()->to('subclass/classlisting/'.$parentId)->with('error','Subclass deleted successfully.');
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }

    /*
    *
    *Get SubClass From Database
    *
    */

    public function getsubclass(Request $request){
        try{
            $id = $request->id;
            $class = classes::where('parent_id', $id)->get();
            return json_encode($class);
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }

}

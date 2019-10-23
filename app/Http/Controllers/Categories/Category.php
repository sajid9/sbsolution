<?php

namespace App\Http\Controllers\Categories;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\categoryValidator;
use App\categories;
use CH;
class Category extends Controller
{
	/*
	*
	* Category Listing Page 
	*
	*/
    public function category_listing()
    {
        $id = CH::getId();
	    $categories = categories::where('user_id',$id)->get();
		return view('pages.categories.category_listing',compact('categories'));
    }

    /*
	*
	* Add Category Form  
	*
	*/

	public function add_category_form(){
    	return view('pages.categories.add_category_form');
    }

    /*
    *
    *Add Category To DataBase
    * 
    */
    public function addcategory(categoryValidator $request){
    	
    	try{
			$request->validated();

			$category = new categories;

		    $category->category_name = $request->category_name;
		    $category->discount     = $request->discount;
		    $category->description  = $request->description;
            $category->user_id  = CH::getId();
		    if($request->has('is_active')){
		    	$category->is_active    = $request->is_active;
		    }else{
		    	$category->is_active    = 'no';
		    }
		    $category->save();

		    return redirect()->to('category/categorylisting')->with('message','Category added successfully.');
    	}catch(\Exception $e){
    		return $e->getMessage();
    	}
    }

    /*
    *
    *Edit Category Form 
    *
    */
    public function editcategory($id){
       $category = categories::find($id);
       return view('pages.categories.edit_category_form',compact('category'));
    }

     /*
    *
    *Update Category To DataBase
    * 
    */

    public function updatecategory(Request $request){
        try{
            $request->validate([
                'category_name' => 'required'
            ]);
            $category = categories::find($request->id);
            $category->category_name = $request->category_name;
            $category->discount     = $request->discount;
            $category->description  = $request->description;
            if($request->has('is_active')){
                $category->is_active    = $request->is_active;
            }else{
                $category->is_active    = 'no';
            }
            $category->save();

            return redirect()->to('category/categorylisting')->with('message','Category updated successfully.');
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }

     /*
    *
    *Delete Category From DataBase 
    *
    */

    public function deletecategory($id){
        try{
            $category = categories::find($id);
            $category->delete();
            return redirect()->to('category/categorylisting')->with('error','Category deleted successfully.');
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }

}

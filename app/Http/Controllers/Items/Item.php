<?php

namespace App\Http\Controllers\Items;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\items;
use App\companies;
use App\categories;
use App\classes;
use App\suppliers;
use App\stores;
use App\stock;
use App\item_ledger;
use App\groups;
use App\sizes;
use App\units;
use App\Http\Requests\itemValidator;
class Item extends Controller
{
    /*
    *
    *Item Listing Page 
    *
    */
    public function item_listing(){
        $items = items::with('companies','categories','countries','classes')->get();
    	return view('pages.items.item_listing',compact('items'));
    }

    /*
    *
    *Add Item Form 
    *
    */
    public function add_item_form(){
        $stores     = stores::where('is_active','yes')->get();
    	$companies  = companies::where('is_active','yes')->get();
    	$categories = categories::where('is_active','yes')->get();
        $groups     = groups::where('is_active','yes')->get();
        $units      = units::where('is_active','yes')->get();
        $sizes      = sizes::where('is_active','yes')->get();
    	$classes    = classes::where('parent_id',0)->get();
    	return view('pages.items.add_item_form',compact('companies','categories','classes','stores','groups','sizes','units'));
    }

    /*
    *
    *Add Item To DataBase
    * 
    */
    public function additem(Request $request){
    	try{
            if($request->has('type')){
			 $request->validate([
                'item_name'      => 'required',
                'barcode'        => 'required|unique:items,barcode',
                'purchase_price' => 'required',
                'sale_price'     => 'required',
                'group'          => 'required',
                'piece_in_box'   => 'required',
                'meter_per_box'  => 'required',
                'size'           => 'required',
            ]);
            }else{
                $request->validate([
                    'item_name'      => 'required',
                    'barcode'        => 'required|unique:items,barcode',
                    'purchase_price' => 'required',
                    'sale_price'     => 'required',
                ]);
            }
			$item = new items;
		    $item->item_name      = $request->item_name;
		    $item->barcode        = $request->barcode;
		    $item->purchase_price = $request->purchase_price;
		    $item->sale_price     = $request->sale_price;
		    $item->company_id     = $request->company;
		    $item->category_id    = $request->category;
		    $item->class_id       = $request->class;
		    $item->sub_class_id   = $request->sub_class;
		    $item->item_desc      = $request->description;
            $item->store_id       = $request->store;
            $item->group_id       = $request->group;
            $item->unit_id        = $request->unit;
            if($request->has('type')){
                $item->color      = $request->color_name;
                $item->pieces     = $request->piece_in_box;
                $item->size       = $request->size;
                $item->quality    = $request->quality;
                $item->meter      = $request->meter_per_box;
                $item->low_stock  = $request->low_stock * $request->piece_in_box;
                $item->tile_type  = $request->tile_type;
                $item->type       = 'tile';
            }else{
                $item->type = 'item';
                $item->low_stock  = $request->low_stock;
            }

		    if($request->has('is_active')){
		    	$item->is_active    = $request->is_active;
		    }else{
		    	$item->is_active    = 'no';
		    }
		    $item->save();
            
		    return redirect()->to('item/itemlisting')->with('message','Item added successfully.');
    	}catch(\Exception $e){
    		return $e->getMessage();
    	}
    }

    /*
    *
    *Edit Company Form 
    *
    */
    public function edititem($id){
       $groups     = groups::where('is_active','yes')->get();
       $units      = units::where('is_active','yes')->get();
       $sizes      = sizes::where('is_active','yes')->get();
       $item       = items::find($id);
       $companies  = companies::all();
       $categories = categories::all();
       $classes    = classes::where('parent_id',0)->get();
       $sub_classes = classes::where('id',$item->sub_class_id)->get();
       return view('pages.items.edit_item_form',compact('item','companies','categories','classes','sub_classes','groups','sizes','units'));
    }

     /*
    *
    *Update Item To DataBase
    * 
    */

    public function updateitem(Request $request){
        try{
            $item = items::find($request->id);
            $item->item_name      = $request->item_name;
            $item->barcode        = $request->barcode;
            $item->purchase_price = $request->purchase_price;
            $item->sale_price     = $request->sale_price;
            $item->company_id     = $request->company;
            $item->category_id    = $request->category;
            $item->class_id       = $request->class;
            $item->sub_class_id   = $request->sub_class;
            $item->item_desc      = $request->description;
            $item->store_id       = $request->store;
            $item->group_id       = $request->group;
            $item->unit_id        = $request->unit;
            if($request->has('type')){
                $item->color      = $request->color_name;
                $item->pieces     = $request->piece_in_box;
                $item->size       = $request->size;
                $item->quality    = $request->quality;
                $item->meter      = $request->meter_per_box;
                $item->low_stock  = $request->low_stock * $request->piece_in_box;
                $item->tile_type  = $request->tile_type;
                $item->type       = 'tile';
            }else{
                $item->type = 'item';
                $item->low_stock  = $request->low_stock;
            }

            if($request->has('is_active')){
                $item->is_active    = $request->is_active;
            }else{
                $item->is_active    = 'no';
            }
            $item->save();

            return redirect()->to('item/itemlisting')->with('message','Item updated successfully.');
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }

    /*
    *
    *Delete Item From DataBase 
    *
    */

    public function deleteitem($id){
        try{
            $item = items::find($id);
            $item->delete();
            return redirect()->to('item/itemlisting')->with('error','Item deleted successfully.');
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }

    /* get Specific item */
    public function get_specific_item(Request $request)
    {
        $item = items::find($request->id);
        return json_encode($item);
    }
}

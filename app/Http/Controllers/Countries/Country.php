<?php

namespace App\Http\Controllers\Countries;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\countryValidator;
use App\countries;
class Country extends Controller
{
    /*
    *
    *Country Listing Page 
    *
    */
    public function country_listing(){
        $countries = countries::all();
    	return view('pages.countries.country_listing',compact('countries'));
    }

    /*
    *
    *Add Country Form 
    *
    */
    public function add_country_form(){
    	return view('pages.countries.add_country_form');
    }

    /*
    *
    *Add Country To DataBase
    * 
    */
    public function addcountry(countryValidator $request){
    	
    	try{
			$request->validated();

			$country = new countries;

		    $country->name        = $request->name;
		    $country->short_code  = $request->short_code;
		    if($request->has('is_active')){
		    	$country->is_active    = $request->is_active;
		    }else{
		    	$country->is_active    = 'no';
		    }
		    $country->save();

		    return redirect()->to('country/countrylisting')->with('message','Country added successfully.');
    	}catch(\Exception $e){
    		return $e->getMessage();
    	}
    }

    /*
    *
    *Edit Country Form 
    *
    */
    public function editcountry($id){
       $country = countries::find($id);
       return view('pages.countries.edit_country_form',compact('country'));
    }

    /*
    *
    *Update Country To DataBase
    * 
    */

    public function updatecountry(Request $request){
        try{
            $request->validate([
                'name'       =>'required',
                'short_code' =>'required'
            ]);
            $country = countries::find($request->id);
            $country->name         = $request->name;
            $country->short_code   = $request->short_code;
            if($request->has('is_active')){
                $country->is_active    = $request->is_active;
            }else{
                $country->is_active    = 'no';
            }
            $country->save();

            return redirect()->to('country/countrylisting')->with('message','Country updated successfully.');
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }

    /*
    *
    *Delete Country From DataBase 
    *
    */

    public function deletecountry($id){
        try{
            $country = countries::find($id);
            $country->delete();
            return redirect()->to('country/countrylisting')->with('error','Country deleted successfully.');
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }

}

<?php

namespace App\Http\Controllers\Companies;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Http\Requests\companyValidator;
use App\companies;
use App\helpers\CustomHelper;
class Company extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    /*
    *
    *Company Listing Page 
    *
    */
    public function company_listing(){
        $companies = companies::all();
    	return view('pages.companies.company_listing',compact('companies'));
    }
    /*
    *
    *Add Company Form 
    *
    */
    public function add_company_form(){
    	return view('pages.companies.add_company_form');
    }

    /*
    *
    *Add Company To DataBase
    * 
    */
    public function addcompany(companyValidator $request){
    	
    	try{
			$request->validated();

			$company = new companies;

		    $company->company_name = $request->company_name;
		    $company->discount     = $request->discount;
		    $company->description  = $request->description;
		    if($request->has('is_active')){
		    	$company->is_active    = $request->is_active;
		    }else{
		    	$company->is_active    = 'no';
		    }
		    $company->save();

		    return redirect()->to('company/companylisting')->with('message','Company added successfully.');
    	}catch(\Exception $e){
    		return $e->getMessage();
    	}
    }

    /*
    *
    *Edit Company Form 
    *
    */
    public function editcompany($id){
       $company = companies::find($id);
       return view('pages.companies.edit_company_form',compact('company'));
    }

    /*
    *
    *Update Company To DataBase
    * 
    */

    public function updatecompany(companyValidator $request){
        try{
            $request->validated();
            $company = companies::find($request->id);
            $company->company_name = $request->company_name;
            $company->discount     = $request->discount;
            $company->description  = $request->description;
            if($request->has('is_active')){
                $company->is_active    = $request->is_active;
            }else{
                $company->is_active    = 'no';
            }
            $company->save();

            return redirect()->to('company/companylisting')->with('message','Company updated successfully.');
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }

    /*
    *
    *Delete Company From DataBase 
    *
    */

    public function deletecompany($id){
        try{
            $company = companies::find($id);
            $company->delete();
            return redirect()->to('company/companylisting')->with('error','Company deleted successfully.');
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }
}

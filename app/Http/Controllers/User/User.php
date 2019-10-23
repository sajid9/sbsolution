<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\company_setting;
use Illuminate\Support\Facades\Storage;
use CH;
class User extends Controller
{
    public function company_setting()
    {
    	$company = company_setting::first();
    	return view('pages.user.add_setting_form',compact('company'));
    }
    public function add_company_setting(Request $request)
    {
        $request->validate(['company_name'=>'required','company_email'=>'required']);
        
    	if($request->id == null){
            $request->validate(['company_logo'=>'required|image|mimes:jpeg,png,jpg,gif,svg']);
    		$path = $request->file('company_logo')->store('company_logo');
    		$setting = new company_setting;
    		$setting->name = $request->company_name;
    		$setting->logo = $path;
    		$setting->email = $request->company_email;
    		$setting->phone = $request->company_phone;
    		$setting->mobile = $request->company_mobile;
    		$setting->website = $request->company_website;
            $setting->address = $request->company_address;
            $setting->user_id = CH::getId();
    		$setting->save();
    		return redirect()->to('user/companysetting')->with('message','Record added Successfully');
    	}else{
    		if($request->hasFile('company_logo')){
                $delete = Storage::delete($request->old_logo);
                if($delete){
    			 $path = $request->file('company_logo')->store('company_logo');
                }
    		}else{
    			$path = $request->old_logo;
    		}
    		$setting = company_setting::find($request->id);
    		$setting->name = $request->company_name;
    		$setting->logo = $path;
    		$setting->email = $request->company_email;
    		$setting->phone = $request->company_phone;
    		$setting->mobile = $request->company_mobile;
    		$setting->website = $request->company_website;
            $setting->address = $request->company_address;
    		$setting->save();
    		return redirect()->to('user/companysetting')->with('message','Record updated Successfully');
    	}
    	
    }
    public function profile()
    {
        return view('pages.user.add_profile_form');    
    }
    public function update_profile(Request $request)
    {
        $user = \Auth::user();
        $user->name = $request->user_name;
        $user->email = $request->user_email;
        $user->save();
        return redirect()->back()->with('message','Profile Updated Successfully');
    }
    public function change_password()
    {
        return view('pages.user.update_password_form');
    }
    public function update_password(Request $request)
    {
        $request->validate([
            'password_confirmation' => 'required',
            'password' => 'required|confirmed'
        ]);

        $user = \Auth::user();
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect()->to('/logout');
    }
}

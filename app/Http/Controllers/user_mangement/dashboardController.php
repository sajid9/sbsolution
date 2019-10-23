<?php

namespace App\Http\Controllers\user_mangement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use App\rolesauthority;
use CH;
class dashboardController extends Controller
{
    


public function index(){
    $user = \Auth::user();
    if($user->type == 'vendor'){
    	$allroles=Role::where('user_id',$user->id)->get();
    	$allusers=User::with('Role')->where('parent_id',$user->id)->get();
    }else if($user->type == 'superadmin'){
    	$allroles=Role::all();
    	$allusers=User::with('Role')->get();
    }else{
    	$allusers = [];
    	$allroles = [];
    }
    
	return view('pages.user_mangement.dashboard',compact('allroles','allusers')); 
}
public function get_authority()
{

    $data = CH::getVendorAuthorities();
    return json_encode($data);
}   
 
}

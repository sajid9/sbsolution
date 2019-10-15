<?php

namespace App\Http\Controllers\user_mangement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;
use App\User;
class dashboardController extends Controller
{
    


   public function index(){
   $allroles=Role::all();
    $allusers=User::with('Role')->get();

 return view('pages.user_mangement.dashboard',compact('allroles','allusers')); 
 }
    
 
}

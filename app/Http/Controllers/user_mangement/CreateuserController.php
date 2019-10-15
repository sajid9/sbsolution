<?php

namespace App\Http\Controllers\user_mangement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
class CreateuserController extends Controller
{
    public function insert(Request $request){
    	

    	 $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8',],
        ]);

$user= new User(['name'=>$request->name,'email'=>$request->email,'password'=>$request->password,'role_id'=>$request->role]);
$user->save();

 return redirect()->back()->with('message','New User Added Successfully');



    }
}

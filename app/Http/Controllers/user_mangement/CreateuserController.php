<?php

namespace App\Http\Controllers\user_mangement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\User;
class CreateuserController extends Controller
{
    public function insert(Request $request){
    	

    	 $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8',],
        ]);

$user= new User(['name'=>$request->name,'email'=>$request->email,'password'=>Hash::make($request->password),'role_id'=>$request->role]);
$user->save();

 return redirect()->to('user_mangement#user')->with('message','New User Added Successfully');



    }

public function update(Request $request , $id){

          $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8',],
        ]);
 $user=User::find($id);
        $user->name=$request->name; 
        $user->email=$request->email;
         $user->password=Hash::make($request->password);
          $user->role_id=$request->role;
        $user->save();
         return redirect()->to('user_mangement#user')->with('message',$user->name.' Role Updated Successfully');
}



    public function destroy($id)
    {

    	$user=User::find($id);
    User::destroy($id);
  
    return redirect()->to('user_mangement#user')->with('message',$user->name.'User Deleted Successfully');
    }

}

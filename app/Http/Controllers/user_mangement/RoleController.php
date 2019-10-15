<?php

namespace App\Http\Controllers\user_mangement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;
class RoleController extends Controller
{
    

public function insert(Request $request){
	
 $request->validate([
            'role_name' => 'required',
            'status'    => 'required'
        ]);
$role= new Role(['role'=>$request->role_name,'status'=>'1']);
$role->save();

 return redirect()->back()->with('message','New Role Added Successfully');

}

 public function destroy($id)
    {

    	$role=Role::find($id);
    Role::destroy($id);
  
    return redirect()->back()->with('message',$role->role.'Role Deleted Successfully');
    }

}

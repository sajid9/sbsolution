<?php

namespace App\Http\Controllers\user_mangement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\rolesauthority;
class CreateuserController extends Controller
{
    public function insert(Request $request){
    	$request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8',],
        ]);
         $user_id = \Auth::user()->id;
		$user= new User(['name'=>$request->name,'email'=>$request->email,'password'=>Hash::make($request->password),'role_id'=>$request->role,"parent_id"=> $user_id,'business_name'=>$request->business,'phone'=>$request->phone]);
        $user->save();

        return redirect()->to('user_mangement#user')->with('message','New User Added Successfully');
    }
    public function add_authority(Request $request)
    {
       
        if($request->parent_id != ''){
            $authority = rolesauthority::find($request->parent_id);
            $authority->role_id = $request->role;
            $authority->authority = serialize($request->roles);
            $authority->selected_ids = serialize($request->id);
            $authority->save();
            return json_encode(['message'=>'Authority Updated']);
        }else{
            $authority = new rolesauthority;
            $authority->role_id = $request->role;
            $authority->authority = serialize($request->roles);
            $authority->selected_ids = serialize($request->id);
            $authority->save();
            return json_encode(['message'=>'Authority Added']);
        }
        
    }

    public function update(Request $request , $id){
        
        $user=User::find($id);
        $user->name=$request->name; 
        $user->email=$request->email;
/*         $user->password=Hash::make($request->password);*/
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
    public function check_role(Request $request)
    {
        $check = rolesauthority::where('role_id',$request->role)->get();
        if(sizeof($check) > 0){
            $check[0]->selected_ids = unserialize($check[0]->selected_ids);
        }
        return json_encode($check);
    }

}

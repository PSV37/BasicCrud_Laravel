<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;	

class ProfileController extends Controller
{
    public function userProfile($slug , $id)
    {
      $user_profile = User::where('id',$id)->get();
     return view('profile.userprofile',compact('user_profile'));
    }

    public function updateProfile(Request $request)
    { 
    	$user_id = $request->id;
    	if($request->hasFile('image') && $request->image->isValid())
        {
           $file = $request->file('image');
           $filename = $file->getClientOriginalName();
           $path = 'userImages';
           $file->move($path , $filename);

           $update_user_profile = User::where('id',$user_id)->update(['image'=>$filename]);
           if($update_user_profile)
           {
           	 session()->flash('update_profile','Updated User Profile');
           	 return back();
           }

        }
        else
        {
        	echo "worng";
            //$filename = 'boy_logo.jpg';
        }
    }

    public function userData(Request $request)
    {
    	$user_id = $request->id;
    	if(isset($request->password) && $request->password!='')
    	{
    		$this->validate($request,[
          'password' => 'required|string|min:6|confirmed',
    	]);

    		$password = Hash::make($request->password);

		    	$user = User::where('id',$user_id)->update([
		           'name' => $request->name,
		           'email' => $request->email,
		           'password'=>$password
		    	]);
		    	
		    	if($user)
		    	{
		    		 session()->flash('update_profile','Updated User Profile');
		           	 return back();
		    	}
    	}
    	
    	$user = User::where('id',$user_id)->update([
           'name' => $request->name,
           'email' => $request->email,
    	]);

    	if($user)
    	{
    		 session()->flash('update_profile','Updated User Profile');
           	 return back();
    	}


    }
}

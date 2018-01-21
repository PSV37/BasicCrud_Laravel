<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\User;
use Auth;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('id','!=',Auth::user()->id)->get();
          return view('home',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
       $user_edit = User::findOrFail($id);
       return view('user.edit',compact('user_edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
       // $this->validate($request->all());
        $user_id = $request->user_id;

        $update_user = User::where('id',$user_id)->update([
          'name'=>$request->name,
          'email'=>$request->email,
          'gender' => $request->gender,
          'role_id' =>$request->role_id
        ]);

        if($update_user)
        {
            session()->flash('update_msg','User Updated');
            return redirect('home');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
       $remove_id = $request->delete_id;

        $user_delete = User::where('id',$remove_id)->delete();
        return response()->json([
         'msg'=>'successfully remove post',
         'status'=>true,
        ]);


    }

    public function active_user(Request $request)
    {
        $user_status = $request->active_status;
        $user_id = $request->user_id;
        $token = Str_random(40);

        $update_status = User::where(['status'=>$user_status,'id'=>$user_id])->update(['status'=>0,'verifyToken'=>$token]);
        if($update_status)
        {
              return response()->json([
                 'msg'=>'successfully Inactive User',
                 'status'=>true,
                ]);
        }
    }

    public function inactive_user(Request $request)
    {
        $user_status = $request->inactive_status;
        $user_id = $request->user_id;
       // $token = Str_random(40);

        $update_status = User::where(['status'=>$user_status,'id'=>$user_id])->update(['status'=>1,'verifyToken'=>'']);
        if($update_status)
        {
              return response()->json([
                 'msg'=>'successfully active User',
                 'status'=>true,
                ]);
        }
        
    }


}

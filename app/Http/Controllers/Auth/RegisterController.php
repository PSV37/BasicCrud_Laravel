<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Str;
use Mail;
use App\Mail\verifyEmail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'gender' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        if($data['gender'] == 'male')
        {
            $user_image = 'boy_logo.jpg';
        }
        else
        {
            $user_image = 'girl_logo.jpg';
        }

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'gender' => $data['gender'],
            'role_id' => $data['role_id'],
            'slug' => str_slug($data['name'],'-'),
            'image' => $user_image,
            'verifyToken' => Str_random(40),
            'status' => 0,
            'password' => bcrypt($data['password']),
        ]);

        $user_info = User::findOrFail($user->id);
       // $this->sendmail($user_info);
    }

    public function sendmail($user_info)
    {
        //Mail::to($user_info['email'])->send(new verifyEmail($user_info));
    }

    public function updateStatus($email ,$token)
    {
        $user = User::where(['email'=>$email , 'verifyToken'=>$token])->first();
        if($user)
        {
            $user->status = 1;
            $user->verifyToken = '';
            $user->save();
             session()->flash('update_status','Successfully Verify Your Account,you can login');
            return redirect('login');
        }
        else
        {
             session()->flash('error','Invalid Email and Token');
            return redirect('login');
        }
    }
}

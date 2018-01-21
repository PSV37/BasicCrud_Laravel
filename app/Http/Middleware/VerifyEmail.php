<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Auth;

class VerifyEmail
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
         $user = User::findOrFail(Auth::id());
         if($user->status == 0)
        {
            Auth::logout();
             session()->flash('login_msg','You Should be Active your email account,Please verify Email');
            return redirect('login');
        }
         return $next($request);

    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckIssetEmail
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
        // check user email
//        if(Auth::user() && is_null(Auth::user()->email)){
//            return redirect()->route('add-email.show');
//        }

        // check active user account
        if(Auth::user() && Auth::user()->active == 0){
            return redirect()->route('index')->with('smallModal', trans('add_email.your_email_no_active'));
        }

        return $next($request);
    }
}

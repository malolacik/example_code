<?php

namespace App\Http\Middleware;

use App\Events\UserReferral;
use App\Models\UserArmcoin;
use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Request;

class CheckLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(config('app.env') == 'production'){
            if(!Request::secure()){
                return redirect(str_replace('http://', 'https://', Request::fullUrl()));
            }


            if (substr(Request::server('HTTP_HOST'), 0, 4) === 'www.') {
                return redirect(str_replace('https://www.', 'https://', Request::fullUrl()));
            }
        }




        if (!Cookie::has('lang')) {
            Cookie::queue('lang', 'en', (60 * 24 * 365));
            App::setLocale('en');
        } else {
            $language = Cookie::get('lang');
            App::setLocale($language);
        }

        if (Auth::user()) {
            // wywal cookies
            $this->deleteCookies();

            // check referral user..
            $this->checkReferral();

            //check wallet (isset any record in DB)
            $this->checkWallet();
        } else {
            if($request->route()->getName() != 'event.show' && $request->route()->getName() != 'video.show'){
                $this->deleteCookies();
            }
        }


        return $next($request);
    }

    public function deleteCookies() : void
    {
        if (Cookie::has('redirect')) {
            Cookie::queue(Cookie::forget('redirect'));
        }
    }

    public function checkReferral() : void
    {
        if(Cookie::has('referral')){
            if(!count(Auth::user()->getUserMaster) && Cookie::get('referral') != Auth::user()->hash){
                event(new UserReferral(Auth::user(), Cookie::get('referral')));
            }
        }
    }

    public function checkWallet() : void
    {
        if(!count(Auth::user()->getUserWalletRecord)){
            //create wallet record in DB:
            // TODO: ogarnąć ten syf bo to na szybko przed urlopem..
            UserArmcoin::create([
                'user_id' => Auth::user()->id,
                'before' => 0,
                'after' => 0,
            ]);
        }
    }
}


















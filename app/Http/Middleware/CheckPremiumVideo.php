<?php

namespace App\Http\Middleware;

use App\Helpers\ChangeTitle;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckPremiumVideo
{

    private $status = 1;
    private $premiumCategory;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $video = $request->route('video');
        $categories = $video->getCategories;
        $this->checkPremiumCategory($categories);


//        dd($this->premiumCategory);
        if($this->status == 0){
            Session::flash('premium_category_error', 1);
            return redirect()
                ->route('category.show', [$this->premiumCategory->id, ChangeTitle::basicTitle($this->premiumCategory->title)]);
        }

        return $next($request);
    }

    public function checkPremiumCategory($categories) : void
    {
        foreach($categories as $category){
            if(!empty($category->getPaymentButton)){
                $this->premiumCategory = $category;
                $this->status = (!Auth::user()) ? 0 : $this->checkAccess($category);
            }
        }
    }

    public function checkAccess($category) : bool
    {
        // check user access
        if(!empty(Auth::user()->getAccessPremiumCategory($category->id))){
            return 1;
        } else{
            return 0;
        }
    }

}

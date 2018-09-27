<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CategoryComposerProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->composeCategory();
    }

    public function composeCategory(){
        view()->composer('front.include_small_partials.aside_category_list', 'App\Http\Composers\CategoryComposer');
    }


}

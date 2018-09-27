<?php


namespace App\Http\Composers;


use App\Models\Category;
use App\Models\Tag;
use App\Models\Video;
use Illuminate\Contracts\View\View;

class CategoryComposer
{

    public function compose(View $view)
    {
        $view->with([
            'categories'    => Category::orderBy('weight')->get(),
            'countVideos'   => Video::whereNotNull('public_date')->count(),
            'tags'          => Tag::orderBy('weight')->get()
        ]);
    }


}
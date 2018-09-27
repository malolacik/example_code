<?php

namespace App\Http\Controllers\Front\Category;

use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class ShowCategoryVideoController extends Controller
{

    public $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function show(Category $category){
        $videos = $category->getActiveVideo()->orderBy('public_date', 'desc');

        // session when user will payment
        $this->putSession($category->id);

        return view('front.category.list')->with([
            'videos'            => $videos->paginate(24),
            'category_title' => $category->title,
            'category' => $category
        ]);
    }

    public function redirectWithTitle(Category $category){
        if(Session::has('messageModal')){
            return redirect($category->getLink())->with('smallModal', Session::get('messageModal'));
        }

        return redirect($category->getLink());
    }

    public function putSession(int $categoryId) : void
    {
        Session::put('payment-session', 'category|'.$categoryId);
    }



}

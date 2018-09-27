<?php

namespace App\Http\Controllers\Front\Category;

use App\Repositories\VideoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShowAllVideoController extends Controller
{

    public $videoRepository;

    public function __construct(VideoRepository $videoRepository)
    {
        $this->videoRepository = $videoRepository;
    }

    public function show()
    {
        return view('front.category.list')->with([
            'videos' => $this->videoRepository->getAllPublicVideo('public_date', 'desc')->paginate(24),
            'category_title' => trans('video.all_video')
        ]);
    }


}

















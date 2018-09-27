<?php

namespace App\Http\Controllers\Front\Video;

use App\Models\Video;
use App\Repositories\CategoryRepository;
use App\Repositories\VideoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class ShowVideoController extends Controller
{

    public $videoRepository;
    public $categoryRepository;

    public function __construct(VideoRepository $videoRepository, CategoryRepository $categoryRepository)
    {
        $this->videoRepository = $videoRepository;
        $this->categoryRepository = $categoryRepository;
    }


    public function show(Video $video){
        $video->update([
            'views' => $video->views + 1
        ]);

        $videoCategoryIds = $video->getCategories->pluck('id')->toArray();
        $videosIds = $this->categoryRepository->getVideoIdByCategoryId($videoCategoryIds)
            ->get()
            ->pluck('video_id')
            ->unique()
            ->forget(8)
            ->toArray();

        if (($key = array_search($video->id, $videosIds)) !== false) {
            unset($videosIds[$key]);
        }

        // all videos category!
        $videos = $this->videoRepository->getVideosByIds($videosIds)->limit(50)->get();
        if(count($videos) > 12){
            $videos = $videos->random(12);
        }

        $videos = $videos->shuffle();

        // session when user will payment
        Session::put('payment-session', 'video|'.$video->id);

        return view('front.video.show', compact('video', 'videos'));
    }

    public function redirectWithTitle(Video $video)
    {
        if(Session::has('messageModal')){
            return redirect($video->getLink())->with('smallModal', Session::get('messageModal'));
        }

        return redirect($video->getLink());
    }





}

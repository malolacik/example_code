<?php

namespace App\Http\Controllers\Front\Homepage;

use App\Models\Event;
use App\Models\Video;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\VideoRepository;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Collection;

class HomepageController extends Controller
{

    public $videoRepository;
    public $videoArray = [3284, 3287, 3309];

    public function __construct(VideoRepository $videoRepository)
    {
        $this->videoRepository = $videoRepository;
    }

    public function show()
    {
        $activeEvent = Event::where([['date_start', '<', date('Y-m-d H:i:s')], ['date_stop', '>', date('Y-m-d H:i:s')]])->first();

        $video = $this->getMainVideo();

        $videos = $this->videoRepository->getAllPublicVideo('public_date', 'desc')->limit(50)->get();

        if (count($videos) > 12) {
            $videos = $videos->random(12);
        }

        $videos = $videos->shuffle();

        return view('front.index.index_content', compact('video', 'activeEvent', 'videos'));
    }

    public function getMainVideo() : Collection
    {
        $video = $this->videoRepository->getVideoWhere('id', '=', $this->videoArray[rand(0, (count($this->videoArray) - 1))])->first();

        if (empty($video)) {
            $video = $this->videoRepository->getRandomFreeVideo();
        }

        Session::put('payment-session', 'video|'.$video->id);

        return $video;
    }


}

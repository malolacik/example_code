<?php

namespace App\Http\Controllers\Admin\Tags;

use App\Repositories\VideoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShowRandomVideoController extends Controller
{

    private $videoRepository;

    public function __construct(VideoRepository $videoRepository)
    {
        $this->videoRepository = $videoRepository;
    }


    public function show(){
        $video = $this->videoRepository->getVideoWithoutTags()->first();
        if(empty($video)){
            return redirect()->back();
        }

        return redirect(route('admin.tags.video', $video->id).'?random');
    }
}

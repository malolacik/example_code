<?php

namespace App\Http\Controllers\Admin\Tags;

use App\Repositories\VideoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShowVideoListWithoutTagsController extends Controller
{

    private $videoRepository;

    public function __construct(VideoRepository $videoRepository)
    {
        $this->videoRepository = $videoRepository;
    }

    public function show(){
        $videos = $this->videoRepository->getVideoWithoutTags();
        return view('admin.tags.video_list_without_tags')->with([
            'videos' => $videos->paginate(100),
            'videosCounter' => $videos->count()
        ]);
    }





}

<?php

namespace App\Http\Controllers\Admin\Video;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\VideoRepository;

class ListVideoController extends Controller
{


    private $videoRepository;

    public function __construct(VideoRepository $videoRepository)
    {
        $this->videoRepository = $videoRepository;
    }

    public function index(){
        return view('admin.video.list')->with([
            'videos' => $this->videoRepository->getAllOrderBy('id', 'desc')->paginate()
        ]);
    }


}

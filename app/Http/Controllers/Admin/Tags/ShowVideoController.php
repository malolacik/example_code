<?php

namespace App\Http\Controllers\Admin\Tags;

use App\Models\Video;
use App\Repositories\TagRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShowVideoController extends Controller
{

    private $tagRepository;

    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }


    public function show(Video $video){
        $propositionTags = explode(' ', $video->title);
        foreach($propositionTags as $key => $propositionTag){
            if(strlen($propositionTag) == 1){
                unset($propositionTags[$key]);
            }
        }


        return view('admin.tags.video', compact('video', 'propositionTags'))->with([
            'tags' => $this->tagRepository->getAll()
        ]);
    }
















}

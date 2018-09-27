<?php

namespace App\Http\Controllers\Front\Tag;

use App\Models\Tag;
use App\Repositories\TagRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShowTagVideoController extends Controller
{

    public $tagRepository;

    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    public function show(Tag $tag){
        $videos = $tag->getActiveVideo()->orderBy('public_date', 'desc');

        return view('front.tag.list')->with([
            'videos' => $videos->paginate(24),
            'tag_title' => $tag->title
        ]);
    }


}

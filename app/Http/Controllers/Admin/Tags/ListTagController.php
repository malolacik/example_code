<?php

namespace App\Http\Controllers\Admin\Tags;

use App\Repositories\TagRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ListTagController extends Controller
{

    private $tagRepository;

    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }


    public function show(){
        return view('admin.tags.list')->with([
            'tags' => $this->tagRepository->getAll()
        ]);
    }








}













<?php

namespace App\Http\Controllers\Admin\Tags;

use App\Http\Requests\TagRequest;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EditTagController extends Controller
{


    public function editView(Tag $tag){
        return view('admin.tags.edit', compact('tag'));
    }

    public function update(TagRequest $request, Tag $tag){
        $tag->update($request->all());

        return redirect()->route('admin.tags.list')
            ->with(['successMessage' => 'Tag "' . $tag->title . '" został edytowany']);
    }




}




<?php

namespace App\Http\Controllers\Admin\Video;

use App\Events\AddArmcoinsToUser;
use App\Events\AddUserEditInfo;
use App\Http\Controllers\Admin\Media\UploadImage;
use App\Http\Requests\VideoRequest;
use App\Models\Video;
use App\Repositories\CategoryRepository;
use App\Repositories\VideoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EditVideoController extends Controller
{

    private $data;
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {

        $this->categoryRepository = $categoryRepository;
    }

    public function editView(Video $video)
    {
        return view('admin.video.edit', compact('video'))->with([
            'categories' => $this->categoryRepository->getAllOrderBy('id', 'desc')->pluck('title', 'id')
        ]);
    }

    public function update(VideoRequest $request, Video $video)
    {
        $this->data = $request->all();

        if (!isset($this->data['image_isset'])) {
            (!$request->hasFile('image')) ? $this->data['image'] = null : $this->data['image'] = (new UploadImage())->uploadImageToDir($request->file('image'), 'video', 3);
        }

        if (!isset($this->data['og_image_isset'])) {
            (!$request->hasFile('open_graph_image')) ? $this->data['open_graph_image'] = null : $this->data['open_graph_image'] = (new UploadImage())->uploadImageToDir($request->file('open_graph_image'), 'video', 4);
        }

        if(!isset($this->data['public_date'])){
            $this->data['public_date'] = null;
        }

        if(!isset($this->data['categories'])){
            $this->data['categories'] = null;
        }

        $video->update($this->data);

        $video->getCategories()->sync($this->data['categories']);

        return redirect()->route('admin.videos.index')
            ->with(['successMessage' => 'Video ' . $video->title . ' zostało edytowane.']);
    }


}











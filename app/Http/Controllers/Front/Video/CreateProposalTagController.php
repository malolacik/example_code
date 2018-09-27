<?php

namespace App\Http\Controllers\Front\Video;

use App\Repositories\ProposalVideoTagRepository;
use App\Repositories\TagRepository;
use App\Repositories\VideoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CreateProposalTagController extends Controller
{


    private $data;
    private $response = [
        'status' => 1,
        'message' => '',
        'id' => 111,
    ];
    private $tagRepository;
    private $proposalVideoTagRepository;
    private $videoRepository;
    private $video;

    public function __construct(TagRepository $tagRepository, ProposalVideoTagRepository $proposalVideoTagRepository, VideoRepository $videoRepository)
    {
        $this->tagRepository = $tagRepository;
        $this->proposalVideoTagRepository = $proposalVideoTagRepository;
        $this->videoRepository = $videoRepository;
    }


    public function addTagProposal(Request $request)
    {
        $this->data = $request->all();

        ($this->response['status'] == 0) ?: $this->validateData();
        ($this->response['status'] == 0) ?: $this->createTag();

        return json_encode($this->response);
    }

    public function validateData() : void
    {
        (!isset($this->data['video_id']) || !is_numeric($this->data['video_id']) ) ? $this->makeErrorResponse(trans('proposal.something_wrong')) : (($this->checkVideo()) ?: $this->makeErrorResponse(trans('proposal.something_wrong')));

        (isset($this->data['tag'])) ?: $this->makeErrorResponse(trans('proposal.must_tag'));
        (strlen($this->data['tag']) <= 15 && strlen($this->data['tag']) > 2) ?: $this->makeErrorResponse(trans('proposal.tag_letters'));

        ($this->response['status'] == 0)?: $this->checkIssetTag();
        ($this->response['status'] == 0)?: $this->checkIssetProposalTag();
    }

    public function checkIssetTag() : void
    {
        $statusTag = 1;
        if(!empty($oldTag = $this->tagRepository->getTagByTagName($this->data['tag']))){
            //znaczy, że istnieje.
            (empty($this->videoRepository->getVideoTagPivot($this->data['video_id'], $oldTag->id)))?: $statusTag = 0;
        }

        ($statusTag == 1) ?: $this->makeErrorResponse(trans('proposal.tag_exists'));
    }

    public function checkIssetProposalTag() : void
    {
        (empty($this->proposalVideoTagRepository->getUserActiveTagByTag(Auth::user()->id, $this->data['tag']))) ?: $this->makeErrorResponse(trans('proposal.tag_already_proposed'));
    }

    public function makeErrorResponse(string $message) : void
    {
        $this->response['status'] = 0;
        $this->response['message'] = $message;
    }

    public function createTag() : Builder
    {
        $this->proposalVideoTagRepository->create([
            'tag'       => $this->data['tag'],
            'video_id'  => $this->data['video_id'],
            'user_id'   => Auth::user()->id,
        ]);
    }

    public function checkVideo() : bool
    {
        return ($this->video = $this->videoRepository->getVideosById($this->data['video_id'])->first()) ? 1 : 0;
    }







}















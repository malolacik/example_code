<?php

namespace App\Http\Controllers\Front\Video;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Repositories\VideoRepository;
use Illuminate\Database\Eloquent\Builder;
use App\Repositories\ProposalVideoTitleRepository;
use App\Repositories\ProposalVideoDescriptionRepository;

class CreateProposalTitleAndDescriptionController extends Controller
{

    private $data;
    private $response = [
        'status' => 1,
        'messages' => [],
    ];
    private $videoRepository;
    private $video;
    private $olderProposal = [];
    private $proposalVideoTitleRepository;
    private $proposalVideoDescriptionRepository;
    private $change = 0;

    public function __construct(VideoRepository $videoRepository, ProposalVideoTitleRepository $proposalVideoTitleRepository, ProposalVideoDescriptionRepository $proposalVideoDescriptionRepository)
    {
        $this->videoRepository = $videoRepository;
        $this->proposalVideoTitleRepository = $proposalVideoTitleRepository;
        $this->proposalVideoDescriptionRepository = $proposalVideoDescriptionRepository;
    }

    public function update(Request $request)
    {
        $this->data = $request->all();
        ($this->response['status'] == 0) ?: $this->validateData();
        ($this->response['status'] == 0) ?: $this->getOlderProposal();
        ($this->response['status'] == 0) ?: $this->updateProposal();

        $this->checkMessageBeforeResponse();


        return json_encode($this->response);
    }

    public function validateData() : void
    {
        if(!isset($this->data['video_id']) || !is_numeric($this->data['video_id']) ){
            $this->response['status'] = 0;
            $this->response['messages'][] = trans('proposal.something_wrong');
        } else{
            if(!$this->checkVideo()){
                $this->response['status'] = 0;
                $this->response['messages'][] = trans('proposal.something_wrong');
            }
        }


        if(isset($this->data['title']) ){
            if(strlen($this->data['title']) < 4 || strlen($this->data['title']) > 200){
                $this->response['status'] = 0;
                $this->response['messages'][] = trans('proposal.title_validate');
            }
        }

        if(isset($this->data['description']) ){
            if(strlen($this->data['description']) < 4 || strlen($this->data['description']) > 20000){
                $this->response['status'] = 0;
                $this->response['messages'][] = trans('proposal.description_validate');
            }
        }
    }

    public function checkVideo() : bool
    {
        return ($this->video = $this->videoRepository->getVideosById($this->data['video_id'])->first()) ? 1 : 0;
    }

    public function getOlderProposal() : void
    {
        $this->olderProposal['title'] = $this->video->getProposalTitleObject(Auth::user()->id);
        $this->olderProposal['description'] = $this->video->getProposalDescriptionObject(Auth::user()->id);
    }

    public function updateProposal() : void
    {
        if(!empty($this->olderProposal['title']) && $this->olderProposal['title']->title != $this->data['title']){
            $this->olderProposal['title']->update([
                'status' => 0,
            ]);
            $this->change = 1;
            (!isset($this->data['title'])) ?: $this->createProposalTitle();
        } else if(empty($this->olderProposal['title'])){
            (!isset($this->data['title'])) ?: $this->createProposalTitle();
        }

        if(!empty($this->olderProposal['description']) && $this->olderProposal['description']->description != $this->data['description']){
            $this->olderProposal['description']->update([
                'status' => 0,
            ]);
            $this->change = 1;
            (!isset($this->data['description'])) ?: $this->createProposalDescription();
        } else if(empty($this->olderProposal['description'])){
            (!isset($this->data['description'])) ?: $this->createProposalDescription();
        }
    }

    public function createProposalTitle() : Builder
    {
        $this->change = 1;
        return $this->proposalVideoTitleRepository->create([
            'user_id'       => Auth::user()->id,
            'title'         => $this->data['title'],
            'video_id'      => $this->data['video_id']
        ]);
    }

    public function createProposalDescription() : Builder
    {
        $this->change = 1;
        return $this->proposalVideoDescriptionRepository->create([
            'user_id'       => Auth::user()->id,
            'description'   => $this->data['description'],
            'video_id'      => $this->data['video_id']
        ]);
    }

    public function checkMessageBeforeResponse() : void
    {
        if($this->response['status'] == 1 && $this->change == 0){
            $this->response['status'] = 2;
            $this->response['messages'][0] = trans('proposal.nothing_changed');
        } else if($this->response['status'] == 1 && $this->change == 1){
            $this->response['messages'][0] = trans('proposal.after_changed');
        }
    }





}
















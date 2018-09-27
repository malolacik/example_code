<?php

namespace App\Http\Controllers\Front\Video;

use App\Repositories\VideoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class VideoVotingController extends Controller
{

    public $videoRepository;
    private $data;
    private $video;
    private $responseData = ['status' => 99, 'message' => '',];
    private $videoVoice;

    public function __construct(VideoRepository $videoRepository)
    {
        $this->videoRepository = $videoRepository;
    }

    public function votingVideo(Request $request)
    {
        $this->data = $request->all();
        $this->validateData();
        ($this->responseData['status'] == 0) ?: $this->getVideo();
        ($this->responseData['status'] == 0) ?: $this->getMyVideoVoice();
        ($this->responseData['status'] == 0) ?: $this->getVideoVoice();

        return json_encode($this->responseData);
    }


    public function validateData() : void
    {
        if (empty($this->data['video_id']) || (isset($this->data['video_id']) && !is_numeric($this->data['video_id']))) {
            $this->responseData['status'] = 0;
        }

        if (empty($this->data['vote']) || (isset($this->data['vote']) && !in_array($this->data['vote'], [1, 2]))) {
            $this->responseData['status'] = 0;
        }
    }

    public function getVideo() : void
    {
        $this->video = $this->videoRepository->getVideosById($this->data['video_id'])->first();
        if (empty($this->video)) {
            $this->responseData['status'] = 0;
        }
    }

    public function getMyVideoVoice() : void
    {
        $this->videoVoice = $this->videoRepository->getUserVideoVoice(Auth::user()->id, $this->video->id);
        $oldVoice = 0; // flag
        if (!empty($this->videoVoice)) {
            $oldVoice = $this->videoVoice->rating;
            // delete voice!!!
            $this->deleteOldVoice();
            $this->responseData['status'] = 10;
        }

        if ($oldVoice != $this->data['vote']){
            $this->addNewVideoVoice();
        }
    }

    public function deleteOldVoice() : void
    {
        $voiceType = ($this->videoVoice->rating == 1) ? 'rating_up' : 'rating_down';
        $this->video->update([$voiceType => $this->video[$voiceType] - 1]);
        $this->videoVoice->update(['status' => 0]);
    }

    public function addNewVideoVoice() : void
    {
        $voiceType = ($this->data['vote'] == 1) ? 'rating_up' : 'rating_down';
        $this->video->update([$voiceType => $this->video[$voiceType] + 1]);
        $this->videoRepository->createUserVideoVoice([
           'user_id' => Auth::user()->id,
           'video_id' => $this->video->id,
           'rating' => $this->data['vote'],
        ]);

        $this->responseData['status'] = $this->data['vote'];
    }

    public function getVideoVoice() : void
    {
        $this->responseData['rating_up']    = $this->video->rating_up;
        $this->responseData['rating_down']  = $this->video->rating_down;
        $this->responseData['video_id']     = $this->video->id;
    }
















}















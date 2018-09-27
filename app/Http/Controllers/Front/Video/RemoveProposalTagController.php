<?php

namespace App\Http\Controllers\Front\Video;


use App\Repositories\ProposalVideoTagRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RemoveProposalTagController extends Controller
{


    private $data;
    private $response = [
        'status' => 1
    ];
    private $proposalVideoTagRepository;
    private $tagObject;

    public function __construct(ProposalVideoTagRepository $proposalVideoTagRepository)
    {
        $this->proposalVideoTagRepository = $proposalVideoTagRepository;
    }

    public function removeTagProposal(Request $request) : array
    {
        /*
         * sprawdzić czy tag istnieje (where id = AJDI, 'status' = 1.
         * sprawdzić czy tag jest mój
         * gdy okej -> zmien STATUS = 0 i reszte też na 0 :P
         *
         * */

        $this->data = $request->all();
        $this->validateData();
        ($this->response['status'] == 0)?: $this->deleteTag();

        return response($this->response);
    }

    public function validateData() : bool
    {
        return (isset($this->data['tagId']) && is_numeric($this->data['tagId'])  && !empty($this->tagObject =  $this->proposalVideoTagRepository->getByIdToRemove(Auth::user()->id, $this->data['tagId']))) ?: $this->response['status'] = 0;
    }

    public function deleteTag() : void
    {
        $this->tagObject->update([
            'status' => 0,
        ]);
    }










}


















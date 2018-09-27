<?php

namespace App\Models;

use App\Helpers\ChangeTitle;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Collection;

class Video extends Model
{


    protected $fillable = [
        'ustream_id',
        'upload_video_id',
        'title',
        'description',
        'resolutions',
        'resolution_status',
        'iframe_code',
        'image',
        'open_graph_image',
        'public_date',
        'price',
        'buy',
        'filename',
        'views',
        'rating_up',
        'rating_down',
    ];


    public function imageUrl() : string
    {
        return url('/img/video/'.$this->image);
    }

    public function openGraphImageUrl() : string
    {
        return url('/img/video/'.$this->open_graph_image);
    }

    public function getCategories(){
        return $this->belongsToMany(Category::class, 'video_categories');
    }

    public function getImage() : string
    {
        $link = '/img/video/';

        if(!is_null($this->image) && Storage::disk('video_upload_thumb')->exists($this->image)){
            return $link.$this->image;
        }

        if(Storage::disk('video_upload_thumb')->exists($this->id.'.jpg')){
            return $link.$this->id.'.jpg';
        }

        return url($link.'default_image.jpg');
    }

    public function getOpenGraphImage() : string
    {
        $link = '/img/video/';
        if(is_null($this->open_graph_image)){
            return url($link.'default_image.jpg');
        }

        return url($link.$this->id.'.jpg');
    }

    public function getLink() : string
    {
        return route('video.show', [$this->id, ChangeTitle::basicTitle($this->title)]);
    }

    public function getShareFacebookLink() : string
    {
        return 'https://www.facebook.com/sharer/sharer.php?u='.$this->getLink();
    }

    public function getShareVkontakteLink() : string
    {
        return 'https://vk.com/share.php?url='.$this->getLink();
    }

    public function getShareGoogleLink() : string
    {
        return 'https://plus.google.com/share?url='.$this->getLink();
    }

    public function getTags()
    {
        return $this->belongsToMany(Tag::class, 'video_tags');
    }

    public function getProposalTitle($userId) : string
    {
        $proposalTitle =  $this->hasMany(ProposalVideoTitle::class)->where([['user_id', $userId], ['status', 1]])->first();

        return (!empty($proposalTitle)) ? $proposalTitle->title : '';
    }

    public function getProposalTitleObject($userId) : string
    {
        $proposalTitle =  $this->hasMany(ProposalVideoTitle::class)->where([['user_id', $userId], ['status', 1]])->first();

        return (!empty($proposalTitle)) ? $proposalTitle : '';
    }

    public function getProposalDescription($userId) : string
    {
        $proposalDescription =  $this->hasMany(ProposalVideoDescription::class)->where([['user_id', $userId], ['status', 1]])->first();

        return (!empty($proposalDescription)) ? $proposalDescription->description : '';
    }

    public function getProposalDescriptionObject($userId) : string
    {
        $proposalDescription =  $this->hasMany(ProposalVideoDescription::class)->where([['user_id', $userId], ['status', 1]])->first();

        return (!empty($proposalDescription)) ? $proposalDescription : '';
    }

    public function getProposalTagsObject($userId) : string
    {
        $proposalTags =  $this->hasMany(ProposalVideoTag::class)->where([['user_id', $userId], ['status', 1]])->orderBy('id', 'desc')->get();

        return (!empty($proposalTags)) ? $proposalTags : '';
    }

    public function getProposalTitles() : Collection
    {
        return $this->hasMany(ProposalVideoTitle::class)->where('status', 1)->orderBy('id')->get();
    }

    public function getProposalDescriptions() : Collection
    {
        return $this->hasMany(ProposalVideoDescription::class)->where('status', 1)->orderBy('id')->get();
    }

    public function getProposalTags() : Collection
    {
        return $this->hasMany(ProposalVideoTag::class)->where('status', 1)->orderBy('id')->get();
    }





}










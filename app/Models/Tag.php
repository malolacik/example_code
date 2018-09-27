<?php

namespace App\Models;

use App\Helpers\ChangeTitle;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{

    protected $fillable = [
        'title',
        'weight'
    ];

    public function getVideo() : BelongsToMany
    {
        return $this->belongsToMany(Video::class, 'video_tags');
    }

    public function countVideo() : int
    {
        return $this->getVideo()->count();
    }

    public function getLink() : string
    {
        return route('tag.show', [$this->id, ChangeTitle::basicTitle($this->title)]);
    }








}











<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoRating extends Model
{
    protected $table = 'videos_ratings';
    protected $fillable = [
        'user_id',
        'video_id',
        'rating',
        'status',
    ];


















}


























<?php
/**
 * Created by PhpStorm.
 * User: Mateusz
 * Date: 10.05.2018
 * Time: 09:27
 */

namespace App\Repositories;


use App\Models\Video;
use App\Models\VideoRating;
use App\Models\VideoTag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class VideoRepository
{


    private $video;
    private $videoRating;
    private $videoTag;

    public function __construct(Video $video, VideoRating $videoRating, VideoTag $videoTag)
    {
        $this->video = $video;
        $this->videoRating = $videoRating;
        $this->videoTag = $videoTag;
    }

    public function getAll()
    {
        return $this->video->all();
    }

    public function getAllPaginate(int $howPerPage = 25) : LengthAwarePaginator
    {
        return $this->video->paginate($howPerPage);
    }

    public function getAllOrderBy(string $column, string $order = 'asc') : Builder
    {
        return $this->video->orderBy($column, $order);
    }

    public function getAllPublicVideo(string $column, string $order = 'asc') : Builder
    {
        return $this->getAllOrderBy($column, $order)->whereNotNull('public_date');
    }

    public function getVideoWhere(string $column, string $operator, string $value) : Builder
    {
        return $this->video->where($column, $operator, $value);
    }

    public function getVideosById(int $videoId) : Builder
    {
        return $this->video->where('id', $videoId);
    }

    public function getVideosByIds(array $videosIds) : Builder
    {
        return $this->video->whereIn('id', $videosIds)->whereNotNull('public_date')->orderBy('public_date', 'desc');
    }

    public function getVideosListByIds(array $videosIds) : Collection
    {
        return $this->getVideosByIds($videosIds)->limit(50)->get();
    }

    public function searchVideo(string $word) : Builder
    {
        return $this->getAllPublicVideo('public_date')->where('title', 'LIKE', '%'.$word.'%')->orWhere('description', 'LIKE', '%'.$word.'%');
    }

    public function getUserVideoVoice(int $userId, int $videoId) : Collection
    {
        return $this->videoRating->where([['user_id', $userId], ['video_id', $videoId], ['status', 1]])->first();
    }

    public function createUserVideoVoice(array $data) : VideoRating
    {
        return $this->videoRating->create($data);
    }

    public function getVideoWithoutTags() : Builder
    {
        $tags = $this->videoTag->all();
        return $this->video->whereNotIn('id', $tags->pluck('video_id'));
    }

    public function getVideosByArrayId(array $videoIds, int $perPage = 20) : LengthAwarePaginator
    {
        return $this->video->whereIn('id', $videoIds)->paginate($perPage);
    }

    public function getVideoTagPivot(int $videoId, int $tagId) : Collection
    {
        return $this->videoTag->where([['video_id', $videoId], ['tag_id', $tagId]])->first();
    }

    public function create(array $data) : Video
    {
        return $this->video->create($data);
    }

    public function getVideoInProgressToNewResolution() : Collection
    {
        return $this->video->where('resolution_status', 2)->first();
    }

    public function getVideoForNewResolutions() : Collection
    {
        return $this->video->where('resolution_status', 0)->whereNotNull('upload_video_id')->orderBy('id', 'desc')->first();
    }

    public function getRandomFreeVideo() : Collection
    {
        return $this->video->where('price', 0)->inRandomOrder()->first();
    }






}


















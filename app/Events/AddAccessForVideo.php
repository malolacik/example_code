<?php

namespace App\Events;

use App\Models\User;
use App\Models\Video;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class AddAccessForVideo
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $video;
    public $accessType;
    public $shoppingId;

    /**
     * Create a new event instance.
     *
     * @param User $user
     * @param Video $video
     * @param $accessType
     * @param $shoppingId
     */
    public function __construct(User $user, Video $video, $accessType, $shoppingId = null)
    {
        $this->user = $user;
        $this->video = $video;
        $this->accessType = $accessType;
        $this->shoppingId = $shoppingId;
    }

}

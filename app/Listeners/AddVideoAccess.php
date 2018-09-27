<?php

namespace App\Listeners;

use App\Events\AddAccessForVideo;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AddVideoAccess
{
    /**
     * Handle the event.
     *
     * @param  AddAccessForVideo  $event
     * @return void
     */
    public function handle(AddAccessForVideo $event) : void
    {
        $event->user->getAllVideoAccess()->attach($event->video->id, [
            'access_type' => $event->accessType,
            'shopping_id' => $event->shoppingId
        ]);
    }
}

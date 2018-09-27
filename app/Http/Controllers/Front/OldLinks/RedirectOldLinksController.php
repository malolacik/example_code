<?php

namespace App\Http\Controllers\Front\OldLinks;

use App\Helpers\ChangeTitle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RedirectOldLinksController extends Controller
{

    private $route = 0;

    public function redirect(){
        $this->route = (isset($_GET))?: 0;
        $this->checkRoute();

        if($this->route == 1){
            return redirect()->route('video.show', [$_GET['id'], ChangeTitle::basicTitle($_GET['title'])]);
        }
        return redirect()->route('index');
    }

    public function checkRoute() : void
    {
        if(isset($_GET['id']) && !empty($_GET['id']) && isset($_GET['title']) && !empty($_GET['title'])){
            $this->route = 1;
        }
    }


}

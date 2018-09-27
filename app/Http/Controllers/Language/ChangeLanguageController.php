<?php

namespace App\Http\Controllers\Language;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;

class ChangeLanguageController extends Controller
{


    private $possibleLanguage = ['en', 'ru'];
    private $defaultLanguage = 'en';


    public function changeLanguage(string $lang)
    {
        if(in_array($lang, $this->possibleLanguage)){
            Cookie::queue('lang', $lang, (60 * 24 * 365));
        } else{
            Cookie::queue('lang', $this->defaultLanguage, (60 * 24 * 365));
        }

        return redirect()->back();
    }






}








<?php
/**
 * Created by PhpStorm.
 * User: Mateusz
 * Date: 11.05.2018
 * Time: 10:11
 */

namespace App\Helpers;


class GetMonthTitle
{


    public static function english(int $month) : string
    {
        $title = '';
        switch ($month) {
            case 1:
                $title = trans('month.january');
                break;
            case 2:
                $title = trans('month.february');
                break;
            case 3:
                $title = trans('month.march');
                break;
            case 4:
                $title = trans('month.april');
                break;
            case 5:
                $title = trans('month.may');
                break;
            case 6:
                $title = trans('month.june');
                break;
            case 7:
                $title = trans('month.july');
                break;
            case 8:
                $title = trans('month.august');
                break;
            case 9:
                $title = trans('month.september');
                break;
            case 10:
                $title = trans('month.october');
                break;
            case 11:
                $title = trans('month.november');
                break;
            case 12:
                $title = trans('month.december');
                break;
        }
        return $title;
    }


}
<?php
/**
 * Created by PhpStorm.
 * User: Mateusz
 * Date: 26.04.2018
 * Time: 12:58
 */

namespace App\Helpers;


class ChangeTitle
{


    public static function clearDiacritics(string $title) : string
    {
        $aReplacePL = array(
            'ą' => 'a', 'ę' => 'e', 'ś' => 's', 'ć' => 'c',
            'ó' => 'o', 'ń' => 'n', 'ż' => 'z', 'ź' => 'z', 'ł' => 'l',
            'Ą' => 'A', 'Ę' => 'E', 'Ś' => 'S', 'Ć' => 'C',
            'Ó' => 'O', 'Ń' => 'N', 'Ż' => 'Z', 'Ź' => 'Z', 'Ł' => 'L',
            //german
            'ü' => 'u', 'Ü' => 'u',
            //cyrylica
            'А' => 'A', 'а' => 'a',
            'Б' => 'B', 'б' => 'b',
            'В' => 'V', 'в' => 'v',
            'Г' => 'G', 'г' => 'g',
            'Д' => 'D', 'д' => 'd',
            'Е' => 'E', 'е' => 'e',
            'Ё' => 'Yo', 'ё' => 'yo',
            'Ж' => 'Zh', 'ж' => 'zh',
            'З' => 'Z', 'з' => 'z',
            'И' => 'I', 'и' => 'i',
            'Й' => 'J', 'й' => 'j',
            'К' => 'K', 'к' => 'k',
            'Л' => 'L', 'л' => 'l',
            'М' => 'M', 'м' => 'm',
            'Н' => 'N', 'н' => 'n',
            'О' => 'O', 'о' => 'o',
            'П' => 'P', 'п' => 'p',
            'Р' => 'R', 'р' => 'r',
            'С' => 'S', 'с' => 's',
            'Т' => 'T', 'т' => 't',
            'У' => 'U', 'у' => 'u',
            'Ф' => 'F', 'ф' => 'f',
            'Х' => 'H', 'х' => 'h',
            'Ц' => 'Ts', 'ц' => 'ts',
            'Ч' => 'Ch', 'ч' => 'ch',
            'Ш' => 'Sh', 'ш' => 'sh',
            'Щ' => 'Shch', 'щ' => 'shch',
            'ы' => 'y',
            'Ы' => 'Y', 'э' => 'e',
            'ю' => 'yu',
            'Э' => 'E', 'я' => 'ya',
            'Ю' => 'Yu',
            'Я' => 'Ya',

            //symbol:
            '#' => '',

        );
        return str_replace(array_keys($aReplacePL), array_values($aReplacePL), $title);
    }

    public static function basicTitle(string $title) : string
    {
        return strtolower(str_replace(" ", "-", self::clearDiacritics($title)));
    }








}
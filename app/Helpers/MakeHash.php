<?php
/**
 * Created by PhpStorm.
 * User: Mateusz
 * Date: 26.04.2018
 * Time: 12:53
 */

namespace App\Helpers;


class MakeHash
{

    public static function alphanumeric(int $howLetters = 10): string
    {
        $codeAlphabet = "A B C D E F G H I J K L M N O P Q R S T U V W X Y Z ";
        $codeAlphabet.= "a b c d e f g h i j k l m n o p q r s t u v w x y z ";
        $codeAlphabet.= "0 1 2 3 4 5 6 7 8 9";
        $one_chars = explode(" ", $codeAlphabet);
        $count_letters = count($one_chars) - 1;

        $hash = '';
        for($i = 1 ; $i <= $howLetters ; $i++){
            $hash .= $one_chars[rand(0, $count_letters)];
        }

        return $hash;
    }

    public static function promotionCode(int $howLetters = 10){
        $codeAlphabet = "a b c d e f g h i j k m n p q r s t u v w x y z ";
        $codeAlphabet .= "2 3 4 5 6 7 8 9";
        $one_chars = explode(" ", $codeAlphabet);
        $count_letters = count($one_chars) - 1;

        $hash = '';
        for($i = 1 ; $i <= $howLetters ; $i++){
            $hash .= $one_chars[rand(0, $count_letters)];
        }

        return $hash;
    }









}
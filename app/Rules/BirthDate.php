<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class BirthDate implements Rule
{

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes(string $attribute, $value) : bool
    {
//        $birthDate = explode('-', $value);
//        dd($value);


        if($value[0] == 0 && $value[1] == 0 && $value[2] == 0){
            return true;
        }

        //year
        if(!is_numeric($value[2]) || $value[2] > date('Y') || $value[2] < date('Y') - 120){
            return false;
        }

        //month
        if(!is_numeric($value[1]) || $value[1] > 12 || $value[1] < 1){
            return false;
        }

        // day
        if(!is_numeric($value[0]) || $value[0] > 31 || $value[0] < 1){
            return false;
        }


        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message() : string
    {
        return trans('register.birth_date_valid');
    }
}

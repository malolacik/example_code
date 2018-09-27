<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class UstreamId implements Rule
{
    private $iframe;

    /**
     * Create a new rule instance.
     *
     * @param $iframe
     */
    public function __construct($iframe)
    {
        $this->iframe = $iframe;
    }


    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes(string $attribute, $value) : bool
    {
        if(!is_null($value) && !is_numeric($value)){
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
        return 'Ustream ID musi być liczbą';
    }
}

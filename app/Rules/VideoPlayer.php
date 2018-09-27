<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class VideoPlayer implements Rule
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
        if(is_null($this->iframe) && is_null($value)){
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
        return 'Musisz podać ustream ID lub kod ifreame!';
    }
}

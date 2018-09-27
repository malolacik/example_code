<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() : bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() : array
    {
        return [
            'title' => 'required|between:1,30',
            'weight' => 'numeric',
        ];
    }

    public function messages() : array
    {
        return [
            'title.required'    => 'Musisz podać nazwe tagu',
            'title.between'     => 'Nazwa tagu może mieć od 1 do 30 znaków',

            'weight.numeric'    => 'Waga tagu musi być liczba',
        ];
    }


}

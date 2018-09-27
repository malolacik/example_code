<?php

namespace App\Http\Requests;

use App\Rules\UstreamId;
use App\Rules\VideoPlayer;
use Illuminate\Foundation\Http\FormRequest;

class VideoRequest extends FormRequest
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
            'ustream_id'        => [new UstreamId($this->input('iframe_code')), new VideoPlayer($this->input('iframe_code'))],
            'title'             => 'required|between:4,200',
            'description'       => 'nullable|between:4,20000',
            'iframe_code'       => 'nullable|max:20000',
            'image'             => 'nullable|mimes:jpeg,jpg|max:15000', // 15 000 kb
            'open_graph_image'  => 'nullable|mimes:jpeg,jpg|max:15000', // 15 000 kb
            'public_date'       => 'nullable|date_format:Y-m-d H:i',
            'price'             => 'numeric',
        ];
    }

    public function messages() : array
    {
        return [


            'title.required' => 'Musisz podać nazwe video',
            'title.between' => 'Nazwa video może mieć od 4 do 200 znaków',

            'description.between' => 'Opis po angielsku może mieć od 4 do 20000 znaków',

            'iframe_code.max' => 'Kod iframe z playerem może mieć maksymalnie 20000 znaków',

            'image.mimes' => 'Nieprawidłowy format obrazka. Obrazek może być w formacie JPEG lub JPG.',
            'open_graph_image.mimes' => 'Nieprawidłowy format "Open Graph Image". "Open Graph Image" może być w formacie JPEG lub JPG.',

            'public_date.required' => 'Musisz podać date startu zawodów',

            'price.numeric' => 'Nieprawidłowa cena eventu w ArmCoinsach. Prawidłowa cena to np. 15000'
        ];
    }
}












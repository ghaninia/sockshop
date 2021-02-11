<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfilePassword extends FormRequest
{

    public function authorize()
    {
        return true ;
    }

    public function rules()
    {
        return [
            "password" => ["required" , "min:5" , "confirmed"] ,
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryStore extends FormRequest
{
    public function authorize()
    {
        return true ;
    }

    public function rules()
    {
        return [
            "picture" => [ "nullable" , "image" ] ,
            "name" => ["required" , "max:255"] ,
            "description" => ["nullable"]
        ];
    }
}

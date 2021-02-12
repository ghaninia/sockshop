<?php

namespace App\Http\Requests;

use App\Rules\MobileRule;
use Illuminate\Foundation\Http\FormRequest;

class SearchStore extends FormRequest
{
    public function authorize()
    {
        return true ;
    }

    public function rules()
    {
        return [
            "mobile" => ["required" , new MobileRule() ] ,
            "tracking_code" => ["required" , "string"]
        ];
    }
}

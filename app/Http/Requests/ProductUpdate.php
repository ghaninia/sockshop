<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductUpdate extends FormRequest
{
    public function authorize()
    {
        return TRUE;
    }

    public function rules()
    {

        return [
            "title" => ["required", "max:255", Rule::unique("products")->ignore($this->route("product")->id ) ],
            "summary" => ["nullable", "max:255"],
            "description" => ["required"],
            "keywords" => ["nullable", "array"],
            "keywords.*" => ["required"],
            "picture" => ["nullable", "image"],
            "galleries" => ["nullable", "array"],
            "galleries.*" => ["required", "image"],

            "variances" => [ "required" , "min:1" , "array"],
            "variances.*.title" => ["required"],
            "variances.*.tooltip" => ["nullable"],
            "variances.*.price" => ["required", "numeric"],
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStore extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "title" => ["required", "max:255", "unique:products"],
            "summary" => ["nullable", "max:255"],
            "description" => ["required"],
            "keywords" => ["nullable", "array"],
            "keywords.*" => ["required"],
            "picture" => ["nullable", "image"],
            "galleries" => ["nullable", "array"],
            "galleries.*" => ["required", "image"],

            "variances" => ["nullable", "array"],
            "variances.*.title" => ["required"],
            "variances.*.tooltip" => ["nullable"],
            "variances.*.price" => ["required", "numeric"],
        ];
    }
}

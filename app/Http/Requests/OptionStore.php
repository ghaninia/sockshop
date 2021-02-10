<?php

namespace App\Http\Requests;

use App\Rules\MobileRule;
use App\Rules\TellphoneRule;
use Illuminate\Foundation\Http\FormRequest;

class OptionStore extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "title" => ["required", "max:255"],
            "description" => ["nullable"],
            "copyright" => ["nullable"],
            "support_mobile" => ["nullable" , new MobileRule() ],
            "support_phone" => ["nullable" , new TellphoneRule() ],
            "support_email" => ["nullable", "email"],
            "shop_description" => ["nullable"],
            "keywords" => ["nullable", "array"],
            "keywords.*" => ["required", "string"],
            "logo" => ["nullable", "image"],
            "favicon" => ["nullable", "image"],
        ];
    }
}

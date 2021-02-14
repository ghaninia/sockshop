<?php

namespace App\Http\Requests;

use App\Rules\MobileRule;
use App\Rules\PersianCharRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderStore extends FormRequest
{
    public function authorize()
    {
        return true ;
    }

    public function rules()
    {
        $variances = $this->route("product")->variances()->pluck("id")->toArray() ;
        return [
            "variance" => ["required" , "numeric", Rule::in($variances) ] ,
            "fullname" => ["required" , new PersianCharRule() ] ,
            "mobile" => ["required" , new MobileRule() ] ,
            "address" => ["required" , "max:".config('site.address') ]
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderUpdate extends FormRequest
{
    public function authorize()
    {
        return true ;
    }

    public function rules()
    {
        return [
            'post_tracking_code' => ["required" , 'string'] ,
            'post_trackinged_at' => ['required' , 'jdate:Y/m/d']
        ];
    }
}

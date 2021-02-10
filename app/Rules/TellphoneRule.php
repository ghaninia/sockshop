<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class TellphoneRule implements Rule
{
    public function __construct()
    {
    }

    public function passes($attribute, $value)
    {
        return preg_match( config("site.regex.tellphone.back") , $value  );
    }

    public function message()
    {
        return 'فرمت شماره وارده صحیح نمیباشد.';
    }
}

<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MobileRule implements Rule
{
    public function __construct()
    {

    }
    public function passes($attribute, $value)
    {
        return preg_match( config("site.regex.mobile.back") , $value ) ;
    }
    public function message()
    {
        return 'فرمت شماره همراه وارد شده درست نمی باشد.';
    }
}

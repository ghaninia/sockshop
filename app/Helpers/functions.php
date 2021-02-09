<?php

use Illuminate\Support\Facades\Auth;
use App\Models\Option;

function avatar()
{
    $avatar = config("site.gender.male");
    return  asset($avatar);
}

function me($guard = "admin")
{
    $guards = config("auth.guards");
    $guards = array_keys($guards);
    if (!in_array($guard,  $guards)) return NULL;
    return Auth::guard($guard)->user();
}

function options($key, $default = null, $defaultValue = true)
{
    return Option::input($key, $default, $defaultValue);
}

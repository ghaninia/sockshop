<?php

use App\Helpers\Attachments\Attachment;
use App\Models\File;
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

function slug($name)
{
    $lettersNumbersSpacesHyphens = '/[^\-\s\pN\pL]+/u';
    $spacesDuplicateHypens = '/[\-\s]+/';
    $slug = preg_replace($lettersNumbersSpacesHyphens, null, $name);
    $slug = preg_replace($spacesDuplicateHypens, '-', $slug);
    $slug = trim($slug, '+');
    if ($slug[strlen($slug) - 1] == "-") {
        $slug = substr($slug, 0, strlen($slug) - 1);
    }
    return $slug;
}


function picture($object, $notPreview = false,  $usage = "picture", $size = 'thumbnail')
{
    $picture = File::show($object, $usage, $size)->first();
    return !!$picture ? $picture : ($notPreview ? null : asset(config("site.preview")));
}

function gallery($type, $size = "thumbnail", $usage = "gallery")
{
    $pictures = File::show($type, $usage, $size);
    return $pictures;
}

function logo($type = "logo" , $notPreview = false ,  $size = "thumbnail")
{
    $logo = options($type) ;
    $logo = json_decode( $logo , true ) ;
    $logo = collect($logo)->where("size" , $size)->values() ;
    $logo =  Attachment::show($logo)->first() ;
    return !!$logo ? $logo : ($notPreview ? null : asset(config("site.preview")));
}

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

function logo($type = "logo", $size = "thumbnail")
{
    try {
        $getLogo = options($type);
        $getLogo = json_decode($getLogo, true);
        if (!!$getLogo && is_array($getLogo) && count($getLogo)) {
            /* logo از فرمت svg و ico ساپورت میشود */
            $hasFile = collect($getLogo)->where("format", "file")->count();
            if ($hasFile) {
                $getLogo = collect($getLogo)->pluck("url");
                $getLogo = Attachment::show($getLogo)->first();
            } else {
                $getLogo = collect($getLogo)->where("size", $size)->pluck("url");
                $getLogo = Attachment::show($getLogo)->first();
            }
            return $getLogo;
        } else {
            throw new Exception("فایل یافت نشده است !");
        }
    } catch (Exception $e) {
        return asset(config("site.preview"));
    }
}

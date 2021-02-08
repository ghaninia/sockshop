<?php

namespace App\Helpers\Attachments\Traits;

use Illuminate\Support\Str;

trait Computing
{
    private function generateName($file)
    {
        $extension =  $file->getClientOriginalExtension();
        $randStr = Str::lower(Str::random(40)) ;
        $orginalName = sprintf("%s.%s", $randStr , $extension);
        return $orginalName;
    }

    private function makeFolder( $disk, $format, $size = null )
    {
        $pathName  = $format;
        $pathName .= !!$size ? DIRECTORY_SEPARATOR . $size : "";
        $disk->makeDirectory($pathName, $mode = 0755);
        return $pathName;
    }
}

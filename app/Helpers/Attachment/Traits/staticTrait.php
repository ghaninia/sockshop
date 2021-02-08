<?php

namespace App\Helpers\Attachment\Traits;

use Illuminate\Support\Facades\Storage;
use Image;
use Illuminate\Support\Str;

trait staticTrait
{

    protected static $rootPath = 'uploads';

    // @return array
    // @return اطلاعات فایل ضمیمه
    //** تمام خصوصیات فایل آپلود شده را بر میگرداند **//
    private function upload($disk, $format, $file, $usage)
    {
        $newName = $this->createNewName($file);
        if ($format == 'image') {
            $size = array_keys(config("site.size"));

            foreach ($size  as $key) {
                $path = $this->makeDirectory($disk, $format, $key);

                $SizeWidth = config("site.size.{$key}.W");
                $SizeHeight = config("site.size.{$key}.H");

                if(!! $SizeWidth && !! $SizeHeight) {
                    $image = Image::make($file)->resize($SizeWidth, $SizeHeight);
                }elseif( !!$SizeHeight xor !!$SizeWidth ) {
                    $image = Image::make($file)->resize( $SizeWidth , $SizeHeight , function ($constraint) {
                        $constraint->aspectRatio();
                    });
                }else{
                    $image = Image::make($file) ;
                }

                $image->encode('data-url')->stream();

                $pathSave = $path . DIRECTORY_SEPARATOR . $newName;

                Storage::put($pathSave , $image );

                $attachmemts[] = [
                    'size' => $key,
                    'format' => $format,
                    'disk' => $disk,
                    'url' => $pathSave,
                    'usage' => $usage
                ];
            }
        } elseif ($format == 'file') {
            $path = $this->makeDirectory($disk, $format);
            $pathSave = $path . DIRECTORY_SEPARATOR . $newName;
            $file->storeAs($path, $newName, $disk);
            $attachmemts[] = [
                'size' => $file->getSize(),
                'format' => $format,
                'disk' => $disk,
                'url' => $pathSave,
                'usage' => $usage
            ];
        }

        return $attachmemts;
    }

    // @return string
    // @return اسم دایرکتوری
    //**  چک وجود داشتن یا نداشتن دایرکتوری در لوکال برنامه **//
    private function makeDirectory($disk, $format, $size = null)
    {
        $path = $format . (!is_null($size) ? DIRECTORY_SEPARATOR . $size : "");
        Storage::disk($disk)->makeDirectory($path, $mode = 0755);;
        return $path;
    }

    // @return string
    // @return new name
    private function createNewName($file)
    {
        $mime =  $file->getClientOriginalExtension();
        // $orginalName = basename($file->getClientOriginalName() , ".".$mime ) ;
        // $orginalName = str_slug($orginalName) ;
        $orginalName = sprintf("%s_%s.%s",  Str::random(10), time(), $mime);
        return $orginalName;
    }
}

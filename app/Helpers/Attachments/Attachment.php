<?php

namespace App\Helpers\Attachments;

use App\Helpers\Attachments\Traits\Computing;
use Illuminate\Support\Facades\Storage;
use Image;

abstract class Attachment
{
    use Computing;

    private $sizes = [
        'full' => [
            "H" => NULL,
            "W" => NULL
        ],
        'thumbnail' => [
            "H" => 200,
            "W" => 200,
        ],
    ];

    private $formats = [
        'file' => [
            'application/pdf',
            'image/vnd.adobe.photoshop',
            'application/postscript',
            'application/postscript',
            'application/postscript',
            'application/zip',
            'application/x-rar-compressed',
            'application/msword',
            'application/rtf',
            'application/vnd.ms-excel',
            'application/vnd.ms-powerpoint',
            'image/x-icon',
            "image/svg+xml"
        ],
        'image' => [
            'image/jpeg',
            'image/png',
            'image/jpg'
        ]
    ];


    public function __construct()
    {
        $this->disk = Storage::disk($this->disk());
    }

    abstract public function disk(): string;

    public function upload(string $fileName, string $usage)
    {
        $file = request()->file($fileName);
        if (!!$file && !is_array($file)) {
            foreach ($this->formats as  $format => $items) {
                foreach ($items as $item) {
                    if ($file->getClientMimetype() === $item) {
                        $this->generate($file, $format, $usage);
                    }
                }
            }
        }
        return FALSE;
    }


    private function generate($file, $format, $usage)
    {
        $name = $this->generateName($file);
        $paths = [];
        switch ($format) {
            case "image": {
                    $image = Image::make($file);
                    $image->backup();
                    foreach ($this->sizes as $size => $parameter) {
                        $path = $this->makeFolder($this->disk, $format, $size);
                        $height = $parameter["H"];
                        $width  = $parameter["W"];
                        // perform some modifications

                        if (!!$width or !!$height) {
                            $image->resize($width, $height, function ($constraint) {
                                $constraint->aspectRatio();
                                $constraint->upsize();
                            });
                        }

                        $savingPath = $path . DIRECTORY_SEPARATOR . $name;
                        $this->disk->put($savingPath, $image->stream());
                        $image->reset();
                        $paths[] = [
                            'size' => $size,
                            'format' => $format,
                            'disk' => $this->disk(),
                            'url' => $savingPath,
                            'usage' => $usage
                        ];
                    }
                    break;
                }
            case "file": {
                    $path = $this->makeFolder($this->disk, $format);
                    $savingPath = $path . DIRECTORY_SEPARATOR . $name;
                    dd($savingPath) ;
                    // $this->disk->put( $savingPath , $file);
                    $paths[] = [
                        'size' => $file->getSize(),
                        'format' => $format,
                        'disk' => $this->disk(),
                        'url' => $savingPath,
                        'usage' => $usage
                    ];
                    break;
                }
        }
        dd($paths);
    }
}

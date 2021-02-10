<?php

namespace App\Helpers\Attachments\Traits;

use App\Helpers\Attachments\Attachment;
use App\Helpers\Attachments\PublicDiskAttachment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

trait HasAttachment
{

    protected static function boot()
    {
        parent::boot() ;
        static::deleting(function($item) {
            $storage = new  PublicDiskAttachment ;
            $storage->remove( $item ) ;
        });
    }

    public static function upload(Model $model, string $fileName, string $usage)
    {
        $storage = new PublicDiskAttachment();
        $storage = $storage->upload($fileName, $usage);
        if (!!$storage && count($storage)) {
            return $model->files()->createMany($storage);
        }
        return false;
    }

    public static function show(Model $model, string $usage = null, string $size = "full"): Collection
    {
        $lists = $model->files()->where([
            'usage'  => $usage,
            'size'   => $size
        ])->get();
        return Attachment::show($lists);
    }
}

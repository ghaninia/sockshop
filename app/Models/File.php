<?php

namespace App\Models;

use App\Helpers\Attachments\Traits\HasAttachment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory, HasAttachment;
    protected $fillable = [
        'size',
        'usage',
        'format',
        'disk',
        'url',
        'fileable_id',
        'fileable_type',
    ];

    protected $guarded = [
        'fileable_id',
        'fileable_type',
    ];

    public function fileables()
    {
        return $this->morphTo();
    }

}

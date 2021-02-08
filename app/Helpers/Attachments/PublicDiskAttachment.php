<?php
namespace App\Helpers\Attachments ;

use App\Helpers\Attachments\Attachment;
use Illuminate\Support\Facades\Storage;

class PublicDiskAttachment extends Attachment
{
    public function disk() : string
    {
        return "public" ;
    }
}

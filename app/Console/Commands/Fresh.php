<?php

namespace App\Console\Commands;

use App\Helpers\Attachments\PublicDiskAttachment;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class Fresh extends Command
{
    protected $signature = 'fresh';

    protected $description = 'reverse all data';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(PublicDiskAttachment $storage)
    {
        Artisan::call("migrate:refresh") ;
        Artisan::call("db:seed") ;
        Artisan::call("storage:link") ;
        Artisan::call("clear-compiled") ;
        $storage->cleanRootFolder() ;
    }
}

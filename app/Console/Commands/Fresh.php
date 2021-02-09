<?php

namespace App\Console\Commands;

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

    public function handle()
    {
        Artisan::call("migrate:refresh") ;
        Artisan::call("clear-compiled") ;
        Storage::deleteDirectory("uploads") ;
    }
}

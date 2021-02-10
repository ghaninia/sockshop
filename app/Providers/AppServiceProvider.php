<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    public function boot()
    {
        Schema::defaultStringLength(141);
        Relation::morphMap([
            "category" => "App\Models\Category",
            "product" => "App\Models\Product",
        ]);
    }
}

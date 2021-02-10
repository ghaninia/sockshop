<?php

use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\OptionController;
use App\Http\Controllers\Dashboard\OrderController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Guest\MainController;

//middleware("auth")->
Route::prefix("dashboard")->name("dashboard.")->group(function () {
    Route::get("/", [DashboardController::class, "index"])->name("main");
    Route::resources([
        "orders" => OrderController::class,
        "products" => ProductController::class,
        "categories" => CategoryController::class
    ]);
    Route::prefix("option")->name("option.")->group(function () {
        Route::get("/", [OptionController::class, "index"])->name("index");
        Route::post("/", [OptionController::class, "store"])->name("store");
    });
    Route::prefix("profile")->name("profile.")->group(function () {
        Route::get("/", [ProfileController::class, "index"])->name("index");
        Route::post("/", [ProfileController::class, "store"])->name("store");
        Route::post("password", [ProfileController::class, "password"])->name("password");
    });
});

Route::namespace("Guest")->name("guest.")->group(function () {
    Route::get('/', [MainController::class, 'index'])->name('main');
    Route::post('/', [MainController::class, 'store'])->name('store');
});

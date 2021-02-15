<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\OptionController;
use App\Http\Controllers\Dashboard\OrderController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Guest\MainController;
use App\Http\Controllers\Guest\OrderController as GuestOrderController;
use App\Http\Controllers\Guest\ProductController as GuestProductController;
use App\Http\Controllers\Guest\SitemapController;

Route::prefix("auth")->name("auth.")->group(function () {
    Route::prefix("login")->name("login.")->group(function () {
        Route::get("/", [LoginController::class, "showLoginForm"])->name("index");
        Route::post("/", [LoginController::class, "login"])->name("store");
    });
    Route::middleware("auth")->post("logout", [LoginController::class, "logout"])->name("logout");
});

Route::prefix("dashboard")->middleware("auth")->name("dashboard.")->group(function () {
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
    Route::get('sitemap.xml', [SitemapController::class, "sitemap"])->name('sitemap');
    Route::get("product/{product}", [GuestProductController::class, 'show'])->name("product");
    Route::middleware("throttle:60,1")->prefix("order")->name("order.")->group(function () {
        Route::get("factor", [GuestOrderController::class, "factor"])->name("factor");
        Route::post("{product}", [GuestOrderController::class, "store"])->name("store");
    });
    Route::get('/', [MainController::class, 'index'])->name('main');
    Route::post('/', [MainController::class, 'store'])->name('store');
});

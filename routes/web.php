<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Guest\MainController;

Route::namespace("Guest")->name("guest.")->group(function () {
    Route::get('/', [MainController::class, 'index'])->name('main');
    Route::post('/', [MainController::class, 'store'])->name('store');
});

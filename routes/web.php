<?php

use App\Http\Controllers\OfferController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('offers')->group(function () {
    Route::get('/', [OfferController::class, 'index'])->name('offers.index');

    Route::post('/', [OfferController::class, 'store'])->name('offers.store');
});


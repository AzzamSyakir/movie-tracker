<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'homePage'])->name('homePage');
Route::get('/movie-details/{movieId}', [HomeController::class, 'movieDetail'])->name('movieDetail');
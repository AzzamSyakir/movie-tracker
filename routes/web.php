<?php

use App\Http\Controllers\ViewController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ViewController::class, 'homePage'])->name('homePage');
Route::get('/movie-details/{movieId}', [ViewController::class, 'movieDetail'])->name('movieDetail');
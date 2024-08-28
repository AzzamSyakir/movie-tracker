<?php

use App\Http\Controllers\home_controller;
use Illuminate\Support\Facades\Route;

Route::get('/', [home_controller::class, 'index'])->name('home');

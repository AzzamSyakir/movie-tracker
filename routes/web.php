<?php

use App\Http\Controllers\ViewController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ViewController::class, 'homePage'])->name('HomeView');

Route::get('/movie-details/{movieId}', [ViewController::class, 'movieDetail'])->name('movieDetail');

Route::get('/signin-form', function (){
  return view('SignIn');
 })->name('SignInView');
 Route::post('/signin', [AuthController::class, 'SignIn'])->name('SignInController');

Route::get('/signup-form', function (){
  return view('SignUp');
 })->name('SignUpView');

Route::post('/signup', [AuthController::class, 'SignUp'])->name('SignUpController');

Route::get('/logout', action: [AuthController::class, 'SignOut'])->name('SignOutController');

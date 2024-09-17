<?php

use App\Http\Controllers\Auth\SocialController;
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

Route::get('login/google/redirect', [SocialController::class, 'GoogleRedirect'])->name('GoogleRedirect');
Route::get('login/google/callback', [SocialController::class, 'GoogleCallback'])->name('GoogleCallback');

Route::get('login/facebook/redirect', [SocialController::class, 'FacebookRedirect'])->name('FacebookRedirect');
Route::get('login/facebook/callback', [SocialController::class, 'FacebookCallback'])->name('FacebookCallback');
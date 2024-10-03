<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Auth\SocialController;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Middleware\EnsureUserAuthenticated;
use Illuminate\Support\Facades\Route;

Route::get('/', [ViewController::class, 'homePage'])->name('HomeView');
Route::get('/popular-movies', [ApiController::class, 'getPopularMovies'])->name('getPopularMovies');
Route::get('/nowPlaying-movies', [ApiController::class, 'getNowPlayingMovies'])->name('getNowPlayingMovies');
Route::get('/topRated-movies', [ApiController::class, 'getTopRatedMovies'])->name('getTopRatedMovies');

Route::get('/movie-details/{movieId}', [ViewController::class, 'MovieDetail'])->name('MovieDetail');

Route::get('/signin-form', function (){
  return view('SignIn');
 })->name('SignInView');
 Route::post('/signin', [AuthController::class, 'SignIn'])->name('SignInController');

Route::get('/signup-form', function (){
  return view('SignUp');
 })->name('SignUpView');
Route::post('/signup', [AuthController::class, 'SignUp'])->name('SignUpController');

Route::get('/logout', [AuthController::class, 'SignOut'])->name('SignOutController');

Route::get('login/google/redirect', [SocialController::class, 'GoogleRedirect'])->name('GoogleRedirect');
Route::get('login/google/callback', [SocialController::class, 'GoogleCallback'])->name('GoogleCallback');

Route::get('login/facebook/redirect', [SocialController::class, 'FacebookRedirect'])->name('FacebookRedirect');
Route::get('login/facebook/callback', [SocialController::class, 'FacebookCallback'])->name('FacebookCallback');

Route::get('/watchlist', [ViewController::class, 'GetWatchlist'])->name('GetWatchlist')->middleware(EnsureUserAuthenticated::class);
Route::post('/add-watchlist/{movieId}', [ViewController::class, 'AddWatchlist'])->name('AddWatchlist')->middleware(EnsureUserAuthenticated::class);
Route::delete('/delete-watchlist/{movieId}', [ViewController::class, 'DeleteWatchlist'])->name('DeleteWatchlist')->middleware(EnsureUserAuthenticated::class);

Route::get('/search-movie/{query}', [ViewController::class, 'SearchMovie'])->name('SearchMovie');
Route::get('/find/{query}', [ViewController::class, 'FindMovie'])->name('FindMovie');

Route::get('/account-setting', [ViewController::class, 'AccountSettingView'])->name('AccountSettingView');
 Route::post('/updateUser', [ViewController::class, 'UpdateUser'])->name('UpdateUser')->middleware(EnsureUserAuthenticated::class);
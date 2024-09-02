<?php
namespace App\Http\Controllers;
class HomeController
{
    public function homePage()
    {
        $apiController = new ApiController();
        $popularMovies = $apiController->getPopularMovies();
        $nowPlayingMovies = $apiController->GetNowPlayingMovies();
        $topRatedMovies = $apiController->GetTopRatedMovies();
        // dd($apiController, $popularMovies, $nowPlayingMovies, $topRatedMovies);
        return view('home', compact('popularMovies', 'nowPlayingMovies', 'topRatedMovies'));
    }
    
}

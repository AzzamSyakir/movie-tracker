<?php
namespace App\Http\Controllers;
use Auth;
class ViewController
{
    protected $apiController;
    public function __construct()
    {
        $this->apiController = new ApiController();
    }
    public function homePage()
    {
        $popularMovies = $this->apiController->getPopularMovies();
        $nowPlayingMovies = $this->apiController->GetNowPlayingMovies();
        $topRatedMovies = $this->apiController->GetTopRatedMovies();
        if(Auth::check()) {
            $userAuthenticate = true;
            return view('Home', compact('popularMovies', 'nowPlayingMovies', 'topRatedMovies', 'userAuthenticate'));

        }
        return view('Home', compact('popularMovies', 'nowPlayingMovies', 'topRatedMovies'));
    }
    public function movieDetail($movieId)
    {
        $movieVideos = $this->apiController->getMovieVideos($movieId);
        $movieDetails = $this->apiController->getMovieDetails($movieId);
    
        if ($movieDetails !== null) {
            return view('MovieDetail', compact('movieDetails', 'movieVideos'));
        }
    
        return view('MovieDetail', compact('movieVideos'));
    }    
    
}

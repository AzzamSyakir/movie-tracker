<?php
namespace App\Http\Controllers;
class HomeController
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
        // dd($popularMovies, $nowPlayingMovies, $topRatedMovies);
        return view('home', compact('popularMovies', 'nowPlayingMovies', 'topRatedMovies'));
    }
    public function movieDetail($movieId)
    {
        $searchMovie = $this->apiController->SearchMovie($movieId);
        dd($movieId);
    }
    
}

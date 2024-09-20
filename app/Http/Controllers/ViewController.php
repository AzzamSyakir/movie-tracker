<?php
namespace App\Http\Controllers;
use App\Models\Watchlist;
use Auth;
use Carbon\Carbon;
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
    public function Watchlist()
    {
        $userId = Auth::user()->id;
        $watchlist = Watchlist::where('user_id', $userId)->first();
        $movies = $watchlist->watchlistMovies;
    
        if ($movies->isNotEmpty()) {
            $movieId = $movies[0]->movie_id;
            $movieVideos = $this->apiController->getMovieVideos($movieId);
            $movieDetails = $this->apiController->getMovieDetails($movieId);
    
            return view('Watchlist', compact('movieVideos', 'movieDetails'));
        }
    
        $watchlist['name'] = Auth::user()->name;
        $createdSince = Carbon::parse($watchlist['created_at']);
        $today = Carbon::now();
        $daysSinceCreation = $createdSince->diffInDays($today);
        
        $watchlist['createdSince'] = round($daysSinceCreation);
        if ($watchlist['createdSince'] == 0) {
            $watchlist['createdSince'] = 'today';
        } elseif ($watchlist['createdSince'] == 1) {
            $watchlist['createdSince'] = '1 day ago';
        } else {
             $watchlist['createdSince'] = "days ago";
        }
        return view('Watchlist', compact('watchlist'))->with('message', 'this list is empty.');
    }
    

}
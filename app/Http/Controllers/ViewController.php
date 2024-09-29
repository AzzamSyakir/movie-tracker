<?php
namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Watchlist;
use App\Models\WatchlistMovie;
use Auth;
use Carbon\Carbon;
use Hash;
use Illuminate\Http\Request;
use Str;
use Validator;
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
    public function GetWatchlist()
    {
        $userId = Auth::user()->id;
        $watchlist = Watchlist::where('user_id', $userId)->first();
    
        $watchlistArray = [
            'name' => Auth::user()->name,
        ];
    
        $createdSince = Carbon::parse($watchlist->created_at);
        $today = Carbon::now();
        $daysSinceCreation = $createdSince->diffInDays($today);
        $daysSinceCreation = round($daysSinceCreation);
    
        if ($daysSinceCreation >= 365) {
            $yearsSinceCreation = round($daysSinceCreation / 365);
            $watchlistArray['createdSince'] = $yearsSinceCreation . ' year' . ($yearsSinceCreation > 1 ? 's' : '') . ' ago';
        } elseif ($daysSinceCreation >= 30) {
            $monthsSinceCreation = round($daysSinceCreation / 30);
            $watchlistArray['createdSince'] = $monthsSinceCreation . ' month' . ($monthsSinceCreation > 1 ? 's' : '') . ' ago';
        } elseif ($daysSinceCreation >= 7) {
            $weeksSinceCreation = round($daysSinceCreation / 7);
            $watchlistArray['createdSince'] = $weeksSinceCreation . ' week' . ($weeksSinceCreation > 1 ? 's' : '') . ' ago';
        } elseif ($daysSinceCreation > 0) {
            $watchlistArray['createdSince'] = $daysSinceCreation . ' day' . ($daysSinceCreation > 1 ? 's' : '') . ' ago';
        } else {
            $watchlistArray['createdSince'] = 'today';
        }
        $movies = $watchlist->watchlistMovies;
    
        if ($movies->isNotEmpty()) {
            foreach ($movies as $watchlistMovie) {
                $movieId = $watchlistMovie->movie_id;
                $movieDetails = $this->apiController->getMovieDetails($movieId);
                $watchlistArray['movies'][] = $movieDetails;
            }
            return view('Watchlist', compact('watchlistArray'));
        }
        
        return view('Watchlist', compact('watchlistArray'))->with('message', $movies->isEmpty() ? 'this list is empty.' : '');
    }
    
    public function addWatchlist($movieId) {
        $userId = Auth::user()->id;
        $watchlist = Watchlist::where('user_id', $userId)->first();
        $watchlistMovies = new WatchlistMovie([
            'id' =>  Str::uuid(),
            'movie_id' => $movieId,
            'watchlist_id' => $watchlist->id
        ]);
        $watchlistMovies->save();
        return redirect()->back();
        }
    public function DeleteWatchlist($movieId){
        $WatchlistMovie = WatchlistMovie::where('movie_id',$movieId);
        $WatchlistMovie->delete();
        return redirect()->back();
    }
    public function SearchMovie($query) {
        $searchMovie = $this->apiController->SearchMovie($query);
        return response()->json($searchMovie);
    }
    public function FindMovie($query) {
        $searchMovie = $this->apiController->SearchMovie($query);
        return view('Find', compact('searchMovie'))->with('keyword', $query);   
    }
    public function updateUser(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => ['nullable', 'email'],
            'password' => ['nullable', 'min:8'],
            'name' => ['nullable']
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
    
        $auth = Auth::user();
        $findUser = User::find($auth->id);
        
        if (array_key_exists('password', $request->all()) && array_key_exists('email', $request->all())) {
            if (!Hash::check($request->input('password'), $findUser->password)) {
                return response()->json(['error' => 'Sorry, wrong password'], 422);
            }
            $auth->password = Hash::make($request->input('password'));
            $auth->email = $request->input('email');
        }
        
        if ($request->input('name') !== null) {
            $auth->name = $request->input('name');
        }
    
        $auth->save();
    
        return response()->json(['success' => 'Account updated successfully']);
    }
    
    public function AccountSettingView() {
        $auth = Auth::user();
        $user =  [
            'name' => $auth->name,
            'email' =>$auth->email,
        ];
        if ($auth->oauth_provider == 'local') {
            return view('AccountSetting', compact('user'))->with('oauthProvider', 'local');
        }
        return view('AccountSetting', compact('user'))->with('oauthProvider', 'non local');
    }
}
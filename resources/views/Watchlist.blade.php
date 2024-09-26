@extends('App')

@section('title', 'Watchlist')

@section('custom-css')
<style>
.watchlist-info {
    background-color: #2e2d2d;
    color: #fff;
    padding: 20px 80px;
    margin-bottom: 20px;
    width: 100%;
}

.watchlist-body {
    background: #fff;
    padding: 20px 80px;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    width: 100%;
}

.movie-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.movie-item {
    display: flex;
    align-items: flex-start;
    margin-bottom: 20px;
    border-bottom: 1px solid #ddd;
    padding-bottom: 20px;
}

.movie-item img {
    width: 100px;
    height: 150px;
    border-radius: 5px;
    margin-right: 20px;
}

.movie-info h3 {
    font-size: 1.2rem;
    margin: 0;
    color: #333;
}

.movie-info p {
    margin: 5px 0;
    color: #666;
    font-size: 0.9rem;
}

.overview {
    margin-top: 5px;
    color: #666;
    font-size: 0.8rem;
}
a.info-btn {
            text-decoration: none;
            background-color: transparent;
        }

.watchlist-btn, .info-btn {
        background-color: transparent;
        border: none;
        color: black;
        font-size: 14px;
        align-items: center;
        padding: 5px 10px;
        cursor: pointer;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .watchlist-btn .fa, .info-btn .fa {
        margin-right: 5px;
    }

    .watchlist-btn:hover, .info-btn:hover {
        background-color: rgba(255, 255, 255, 0.1);
        color: #5e5d5b;
    }

    .watchlist-btn:hover .fa, .info-btn:hover .fa {
        color: #5e5d5b;
    }
</style>
@endsection

@section('content')
<div class="watchlist-info">
    <h1>Your Watchlist</h1>
    <p>by {{ $watchlistArray['name'] }} • Created {{ $watchlistArray['createdSince'] }}</p>
    <p>Your Watchlist helps you keep track of the movies you're interested in.</p>
</div>

<div class="watchlist-body">
    @if (isset($message))
        <p>{{ $message }}</p>
    @else
        <ul class="movie-list">
        <h4>{{ count($watchlistArray['movies']) }} list</h4>
            @foreach ($watchlistArray['movies'] as $movie)
                <li class="movie-item">
                    <img src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] }}" alt="{{ $movie['title'] }}">
                    <div class="movie-info">
                        <h3>{{ $movie['title'] }}</h3>
                        <p>Release Date: {{ $movie['release_date'] }}</p>
                        <p class="overview">{{ $movie['overview'] }}</p>
                        <div class="button-group">
                            <a class="info-btn" href="{{ route('MovieDetail', $movie['id'])}}">
                                <i class="fa fa-info-circle"></i> Info
                            </a>
                            <form action="{{ route('DeleteWatchlist', $movie['id']) }}" method="POST" style="display: inline;">
                                @method("DELETE")    
                                @csrf
                                <button class="watchlist-btn" type="submit">
                                    <i class="fa fa-plus-circle"></i> Remove Watchlist
                                </button>
                            </form>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection

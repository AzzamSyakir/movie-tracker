@extends('App')

@section('title', 'Find')

@section('custom-css')
    <style>
        .movie-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 15px;
            padding: 15px;
            border-bottom: 1px solid #ddd;
            border-radius: 5px;
            overflow: hidden
        }
        .movie-item img {
            width: 100%;
            height: auto;
            max-width: 120px;
            border-radius: 5px;
            margin-right: 15px;
        }
        .movie-info {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
        .movie-info strong {
            font-size: 1.2em;
            margin-bottom: 5px;
            color: #555;
        }
        .movie-info p {
            margin: 5px 0;
            color: #555;
        }
        .movie-rating {
            font-weight: bold;
            margin-top: 5px;
            color: #555
        }
        .movie-buttons {
            margin-top: auto;
            display: flex;
            gap: 5px;
        }
        .movie-buttons button {
            padding: 5px 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .btn-watchlist{
            background-color: transparent;
            border: none;
            font-size: 14px;
            display: flex;
            align-items: center;
            padding: 10px 10px;
            cursor: pointer;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        a:hover {
            text-decoration: none;
        }

    </style>
@endsection

@section('custom-js')
    <script>
    </script>
@endsection

@section('content')
    <div class="container">
        <h3>Search for "{{ $keyword }}"</h3>

        <div class="movie-list">
            @if(count($searchMovie) > 0)
                @foreach($searchMovie as $movie)
                    <div class="movie-item">
                        <a href="{{ route('MovieDetail', $movie['id']) }}" style="display: flex; width: 100%;">
                            <img src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] }}" alt="{{ $movie['title'] }}">
                            <div class="movie-info">
                                <strong>{{ $movie['title'] }}</strong>
                                <p>{{ Str::limit($movie['overview'], 100) }}</p>
                                <div class="movie-rating">Rating: {{ $movie['vote_average'] }}</div>
                                <div class="movie-buttons">
                                <form action="{{ route('AddWatchlist', $movie['id']) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        <button class="watchlist-btn" type="submit">
                                                            <i class="fa fa-plus-circle"></i> Watchlist
                                                        </button>
                                                    </form>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            @else
                <p>No movies found for "{{ $keyword }}".</p>
            @endif
        </div>
    </div>
@endsection

@extends('App')

@section('title', 'Find')

@section('custom-css')
    <style>
        .movie-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        .movie-item img {
            width: 50px;
            height: auto;
            margin-right: 15px;
        }
        .movie-item .movie-info {
            display: flex;
            flex-direction: column;
        }
        .movie-item a {
            text-decoration: none;
            color: inherit;
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
                        <a href="{{ route('MovieDetail', ['id' => $movie['id']]) }}">
                            <img src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] }}" alt="{{ $movie['title'] }}">
                            <div class="movie-info">
                                <strong>{{ $movie['title'] }}</strong>
                                <p>{{ Str::limit($movie['overview'], 100) }}</p>
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
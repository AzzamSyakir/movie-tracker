@extends('App')

@section('title', $movieDetails['title'])
@section('custom-css')
    <style>
        .movie-detail.mobile-only {
            display: none;
        }
        .movie-detail.desktop-only {
            display: block;
        }
        body {
            background-color: #f4f4f4;
            color: #333;
            font-family: Arial, sans-serif;
        }
        .movie-detail {
            max-width: 1200px;
            margin: 20px auto;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            padding: 20px;
        }
        .movie-header {
            display: flex;
            flex-direction: row;
            align-items: flex-start;
            margin-bottom: 20px;
        }
        .movie-header.no-trailer {
            flex-direction: row;
        }
        .trailer-container iframe {
            width: 100%;
            height: 100%;
            border: none;
            border-radius: inherit;
        }
        .movie-poster {
            max-width: 220px;
            width: 100%;
            height: 315px;
            border-radius: 5px;
            margin-right: 20px;
        }
        .trailer-container {
            flex: 1;
            margin-right: 20px;
        }
        .trailer-container iframe {
            width: 100%;
            height: 315px;
            border-radius: 5px;
        }
        .movie-info {
            flex: 1;
        }
        .movie-header.no-trailer .movie-info {
            margin-left: 0;
        }
        .movie-title {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .movie-rating {
            font-size: 1.2rem;
            color: #f5c518;
            margin-bottom: 10px;
        }
        .movie-genre {
            font-size: 1rem;
            color: #888;
            margin-bottom: 20px;
        }
        .movie-overview {
            font-size: 1rem;
            line-height: 1.6;
            margin-bottom: 20px;
        }
        .movie-details {
            margin-bottom: 20px;
        }
        .movie-details dt {
            font-weight: bold;
        }
        .movie-details dd {
            margin: 0 0 10px;
        }
        .btn-back {
            font-size: 1rem;
            font-weight: bold;
            text-decoration: none;
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            display: inline-block;
            transition: background-color 0.3s ease;
        }
        .btn-back:hover {
            background-color: #0056b3;
        }
        /* media queries */
@media (max-width: 768px) {
    .movie.movie-poster{
        flex: 0 0 30%;
    } 
    .trailer-container {
        flex: 0 0 70%;
        margin-right: 30px;  
        }
    .movie-header {
        display: flex;
        flex-direction: row;
        align-items: flex-start;
        margin-bottom: 20px;
    }
}
@media (max-width: 576px) {
    .movie-detail.mobile-only {
        display: block;
        padding: 10px;
    }
    .movie-detail.desktop-only {
        display: none;
    }
    .movie-title {
        width: 100%;
        text-align: left;
        font-size: 1.5em;
        margin-bottom: 10px;
    }

    .movie-info-top {
        display: flex;
        justify-content: space-between;
        width: 100%;
        margin-bottom: 10px;
    }

    .movie-genre {
        flex: 1;
        text-align: left;
    }

    .movie-rating {
        flex: 0 0 auto;
        margin-left: 10px;
    }

    .trailer-container {
        width: 100%;
        margin-bottom: 20px;
    }

    .movie-content {
        display: flex;
        width: 100%;
        align-items: center;
        margin-bottom: 20px;
    }

    .movie-poster {
        flex: 0 0 10%;
        max-width: 200px;
        margin-right: 10px;
        max-height: 250px;
    }

    .movie-overview {
        flex: 1;
        text-align: left;
        font-size: 0.8rem;
    }

    .movie-details {
        clear: both;
        width: 100%;
        margin-top: 20px;
    }

    .btn-back {
        display: block;
        margin-top: 20px;
        text-align: center;
    }
}
    </style>
@endsection
@section('custom-js')
@endsection
@section('content')
<div class="container movie-detail desktop-only">
    <div class="movie-header @if(!isset($movieVideos) || count($movieVideos) == 0) no-trailer @endif">
        <img class="movie-poster" src="https://image.tmdb.org/t/p/w500{{ $movieDetails['poster_path'] }}" alt="{{ $movieDetails['title'] }}">

        @if(isset($movieVideos) && count($movieVideos) > 0)
            <div class="trailer-container">
                @foreach($movieVideos as $video)
                    @if($video['type'] === 'Trailer')
                        <iframe src="https://www.youtube.com/embed/{{ $video['key'] }}" frameborder="0" allowfullscreen></iframe>
                        @break
                    @endif
                @endforeach
            </div>
        @endif
    </div>

    <div class="movie-info">
        <h1 class="movie-title">{{ $movieDetails['title'] }}</h1>
        <div class="movie-rating">
            <i class="fa fa-star"></i> {{ number_format($movieDetails['vote_average'], 1) }} ({{ $movieDetails['vote_count'] }} votes)
        </div>
        <div class="movie-genre">
            @foreach ($movieDetails['genres'] as $genre)
                {{ $genre['name'] }}@if (!$loop->last), @endif
            @endforeach
        </div>
        <div class="movie-overview">
            {{ $movieDetails['overview'] }}
        </div>
        <div class="movie-details">
            <dl>
                <dt>Release Date:</dt>
                <dd>{{ $movieDetails['release_date'] }}</dd>
                <dt>Runtime:</dt>
                <dd>{{ $movieDetails['runtime'] }} minutes</dd>
                <dt>Tagline:</dt>
                <dd>{{ $movieDetails['tagline'] }}</dd>
                <dt>Homepage:</dt>
                <dd><a href="{{ $movieDetails['homepage'] }}" target="_blank">{{ $movieDetails['homepage'] }}</a></dd>
                <dt>Production Companies:</dt>
                <dd>
                    @foreach ($movieDetails['production_companies'] as $company)
                        {{ $company['name'] }}@if (!$loop->last), @endif
                    @endforeach
                </dd>
            </dl>
        </div>
        <a class="btn-back" href="/">Back to Home</a>
    </div>
</div>
<div class="container movie-detail mobile-only">
    <h1 class="movie-title">{{ $movieDetails['title'] }}</h1>

    <div class="movie-info-top">
        <div class="movie-genre">
            @foreach ($movieDetails['genres'] as $genre)
                {{ $genre['name'] }}@if (!$loop->last), @endif
            @endforeach
        </div>
        <div class="movie-rating">
            <i class="fa fa-star"></i> {{ number_format($movieDetails['vote_average'], 1) }} ({{ $movieDetails['vote_count'] }} votes)
        </div>
    </div>

    @if(isset($movieVideos) && count($movieVideos) > 0)
        <div class="trailer-container">
            @foreach($movieVideos as $video)
                @if($video['type'] === 'Trailer')
                    <iframe src="https://www.youtube.com/embed/{{ $video['key'] }}" frameborder="0" allowfullscreen></iframe>
                    @break
                @endif
            @endforeach
        </div>
    @endif

    <div class="movie-content">
        <img class="movie-poster" src="https://image.tmdb.org/t/p/w500{{ $movieDetails['poster_path'] }}" alt="{{ $movieDetails['title'] }}">
        <div class="movie-overview">
            {{ $movieDetails['overview'] }}
        </div>
    </div>

    <div class="movie-details">
        <dl>
            <dt>Release Date:</dt>
            <dd>{{ $movieDetails['release_date'] }}</dd>
            <dt>Runtime:</dt>
            <dd>{{ $movieDetails['runtime'] }} minutes</dd>
            <dt>Tagline:</dt>
            <dd>{{ $movieDetails['tagline'] }}</dd>
            <dt>Homepage:</dt>
            <dd><a href="{{ $movieDetails['homepage'] }}" target="_blank">{{ $movieDetails['homepage'] }}</a></dd>
            <dt>Production Companies:</dt>
            <dd>
                @foreach ($movieDetails['production_companies'] as $company)
                    {{ $company['name'] }}@if (!$loop->last), @endif
                @endforeach
            </dd>
        </dl>
    </div>

    <a class="btn-back" href="/">Back to Home</a>
</div>

@endsection

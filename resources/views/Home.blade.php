@extends('App')

@section('title', 'Home Page')
@section('custom-css')
    <style>
        .movie-card {
            border: 1px solid #ddd;
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            position: relative;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .movie-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .movie-info {
            padding: 10px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            position: absolute;
            bottom: 0;
            width: 100%;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .movie-card:hover .movie-info {
            opacity: 1;
        }

        .movie-title {
            font-size: 1.1rem;
            margin: 0;
            text-align: center;
        }

        .movie-rating {
            display: flex;
            align-items: center;
            margin: 5px 0;
            text-align: center;
        }

        .star-rating {
            margin-right: 5px;
        }

        .movie-rating i {
            color: #ffcc00;
        }
        a.info-btn {
            text-decoration: none;
            background-color: transparent;
        }

        .button-group {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0;
            position: absolute;
            bottom: 10px;
            width: 100%;
        }

        .watchlist-btn, .info-btn {
            background-color: transparent;
            border: none;
            color: white;
            font-size: 14px;
            display: flex;
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
            color: #f1f1f1;
        }

        .watchlist-btn:hover .fa, .info-btn:hover .fa {
            color: #f1f1f1;
        }

        .carousel-control-prev, 
        .carousel-control-next {
            width: 40px;
            height: 40px;
            background-color: rgba(128, 128, 128, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 5px;
            display: flex;
            justify-content: center;
            align-items: center;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            z-index: 10;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .carousel-control-prev:hover,
        .carousel-control-next:hover {
            background-color: rgba(128, 128, 128, 0.4);
        }

        .carousel-control-prev.disabled,
        .carousel-control-next.disabled {
            opacity: 0.5;
            cursor: not-allowed;
            background-color: rgba(128, 128, 128, 0.1);
            border-color: rgba(255, 255, 255, 0.3);
        }

        .carousel-control-prev.disabled:hover,
        .carousel-control-next.disabled:hover {
            background-color: rgba(128, 128, 128, 0.1);
        }
    </style>
@endsection
@section('custom-js')
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script>
            $(document).ready(function () {
                function updateCarouselControls(carouselId) {
                    var carousel = $(carouselId);
                    var activeIndex = carousel.find('.carousel-item.active').index();
                    var itemCount = carousel.find('.carousel-item').length;

                    carousel.find('.carousel-control-prev').toggleClass('d-none', activeIndex === 0);
                    carousel.find('.carousel-control-next').toggleClass('d-none', activeIndex === itemCount - 1);
                }

                $('.carousel').on('slid.bs.carousel', function () {
                    updateCarouselControls('#' + $(this).attr('id'));
                });

                $('.carousel').each(function () {
                    updateCarouselControls('#' + $(this).attr('id'));
                });
            });
        </script>
@endsection
@section('content')
    <div class="container mt-4">
        <!-- Popular Movies Carousel -->
        <div id="popularMoviesCarousel" class="carousel slide mb-4" data-ride="carousel" data-interval="false">
            <h5>Popular Movies</h5>
            <div class="d-flex justify-content-between align-items-center position-relative">
                <a class="carousel-control-prev" href="#popularMoviesCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <div class="carousel-inner w-100">
                    @foreach (array_chunk($popularMovies, 6) as $index => $chunk)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                            <div class="row">
                                @foreach ($chunk as $movie)
                                    <div class="col-md-2 mb-3">
                                        <div class="movie-card">
                                            <img src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] }}" alt="{{ $movie['title'] }}">
                                            <div class="movie-info">
                                                <h2 class="movie-title">{{ $movie['title'] }}</h2>
                                                <div class="movie-rating">
                                                    <div class="star-rating">
                                                        @for ($i = 0; $i < floor($movie['vote_average'] / 2); $i++)
                                                            <i class="fa fa-star"></i>
                                                        @endfor
                                                        @if ($movie['vote_average'] % 2 != 0)
                                                            <i class="fa fa-star-half-alt"></i>
                                                        @endif
                                                    </div>
                                                    <span>{{ number_format($movie['vote_average'], 1) }}</span>
                                                </div>
                                                <div class="button-group">
                                                    <form action="{{ route('AddWatchlist', $movie['id']) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        <button class="watchlist-btn" type="submit">
                                                            <i class="fa fa-plus-circle"></i> Watchlist
                                                        </button>
                                                    </form>
                                                    <a class="info-btn" href="{{ route('MovieDetail', $movie['id'])}}">
                                                        <i class="fa fa-info-circle"></i> Info
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
                <a class="carousel-control-next" href="#popularMoviesCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <!-- Now Playing Movies Carousel -->
        <div id="nowPlayingMoviesCarousel" class="carousel slide mb-4" data-ride="carousel" data-interval="false">
            <h5>Now Playing Movies</h5>
            <div class="d-flex justify-content-between align-items-center position-relative">
                <a class="carousel-control-prev" href="#nowPlayingMoviesCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <div class="carousel-inner w-100">
                    @foreach (array_chunk($nowPlayingMovies, 6) as $index => $chunk)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                            <div class="row">
                                @foreach ($chunk as $movie)
                                    <div class="col-md-2 mb-3">
                                        <div class="movie-card">
                                            <img src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] }}" alt="{{ $movie['title'] }}">
                                            <div class="movie-info">
                                                <h2 class="movie-title">{{ $movie['title'] }}</h2>
                                                <div class="movie-rating">
                                                    <div class="star-rating">
                                                        @for ($i = 0; $i < floor($movie['vote_average'] / 2); $i++)
                                                            <i class="fa fa-star"></i>
                                                        @endfor
                                                        @if ($movie['vote_average'] % 2 != 0)
                                                            <i class="fa fa-star-half-alt"></i>
                                                        @endif
                                                    </div>
                                                    <span>{{ number_format($movie['vote_average'], 1) }}</span>
                                                </div>
                                                <div class="button-group">
                                                    <form action="{{ route('AddWatchlist', $movie['id']) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        <button class="watchlist-btn" type="submit">
                                                            <i class="fa fa-plus-circle"></i> Watchlist
                                                        </button>
                                                    </form>
                                                    <a class="info-btn" href="{{ route('MovieDetail', $movie['id'])}}">
                                                        <i class="fa fa-info-circle"></i> Info
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
                <a class="carousel-control-next" href="#nowPlayingMoviesCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <!-- Top Rated Movies Carousel -->
        <div id="topRatedMoviesCarousel" class="carousel slide mb-4" data-ride="carousel" data-interval="false">
            <h5>Top Rated Movies</h5>
            <div class="d-flex justify-content-between align-items-center position-relative">
                <a class="carousel-control-prev" href="#topRatedMoviesCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <div class="carousel-inner w-100">
                    @foreach (array_chunk($topRatedMovies, 6) as $index => $chunk)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                            <div class="row">
                                @foreach ($chunk as $movie)
                                    <div class="col-md-2 mb-3">
                                        <div class="movie-card">
                                            <img src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] }}" alt="{{ $movie['title'] }}">
                                            <div class="movie-info">
                                                <h2 class="movie-title">{{ $movie['title'] }}</h2>
                                                <div class="movie-rating">
                                                    <div class="star-rating">
                                                        @for ($i = 0; $i < floor($movie['vote_average'] / 2); $i++)
                                                            <i class="fa fa-star"></i>
                                                        @endfor
                                                        @if ($movie['vote_average'] % 2 != 0)
                                                            <i class="fa fa-star-half-alt"></i>
                                                        @endif
                                                    </div>
                                                    <span>{{ number_format($movie['vote_average'], 1) }}</span>
                                                </div>
                                                <div class="button-group">
                                                    <form action="{{ route('AddWatchlist', $movie['id']) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        <button class="watchlist-btn" type="submit">
                                                            <i class="fa fa-plus-circle"></i> Watchlist
                                                        </button>
                                                    </form>
                                                    <a class="info-btn" href="{{ route('MovieDetail', $movie['id'])}}">
                                                        <i class="fa fa-info-circle"></i> Info
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
                <a class="carousel-control-next" href="#topRatedMoviesCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
@endsection

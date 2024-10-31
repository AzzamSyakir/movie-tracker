@extends('App')

@section('title', 'Home Page')
@section('custom-css')
<style>
    /* Movie Card Styles */
    .movie-card {
        position: relative;
        border-radius: 8px;
        overflow: hidden;
        background: #fff;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        display: flex;
        flex-direction: column;
    }

    .movie-poster {
        width: 100%;
        height: 250px;
        object-fit: cover;
    }

    .movie-info {
        background: #1f1f1f;
        color: #fff;
        padding: 5px;
        text-align: center;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .movie-details {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .movie-title {
        font-size: 18px;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        text-overflow: ellipsis;
        text-align: left;
        margin-bottom: 10px;
    }


    .movie-rating {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }

    .movie-rating .fa-star {
        color: gold;
        font-size: 10px;
    }

    .rating {
        font-weight: bold;
    }

    .watchlist-btn, .trailer-btn {
        background: none;
        border: none;
        color: #fff;
        cursor: pointer;
        padding: 5px;
        display: inline-flex;
        align-items: center;
    }

    .watchlist-btn:hover, .trailer-btn:hover {
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        transition: all 0.3s ease;
    }

    .fa-plus-circle, .fa-info {
        margin-right: 5px;
    }

    .button-group {
        display: flex;
        justify-content: center;
        gap: 10px;
        flex-direction: column;
        align-items: center;
        margin-top: auto;
    }

    /* Section: Carousel Button Styles */
    .carousel-control-prev, .carousel-control-next {
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

    .carousel-control-prev:hover, .carousel-control-next:hover {
        background-color: rgba(128, 128, 128, 0.4);
    }

    .carousel-control-prev.disabled, .carousel-control-next.disabled {
        opacity: 0.5;
        cursor: not-allowed;
        background-color: rgba(128, 128, 128, 0.1);
        border-color: rgba(255, 255, 255, 0.3);
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .carousel-item .row {
            flex-wrap: nowrap;
        }
        .movie-title, .movie-rating .fa-star, .button-group button, .button-group a {
            font-size: 0.9rem;
        }

        .button-group button, .button-group a {
            padding: 3px 5px;
        }
    }

    @media (max-width: 425px) {
        .carousel-item .row {
            flex-wrap: nowrap;
        }

        .carousel-control-prev, .carousel-control-next {
            width: 30px;
            height: 30px;
        }
    }
    @media (max-width: 375px) {
        .movie-title, .movie-rating .fa-star, .button-group button, .button-group a {
            font-size: 0.75rem;
        }
    }

    @media (max-width: 320px) {
        .movie-title, .movie-rating .fa-star, .button-group button, .button-group a {
            font-size: 0.7rem;
        }
    }
</style>
@endsection
@section('custom-js')
        <script>
              document.addEventListener('DOMContentLoaded', function() {
                adjustCarouselItems();
                window.addEventListener('resize', adjustCarouselItems);
            });
            
    function adjustCarouselItems() {
    const screenWidth = window.innerWidth;
    const carouselItems = document.querySelectorAll('.carousel .carousel-item');

    carouselItems.forEach((item) => {
        const movies = Array.from(item.querySelectorAll('.movie-card'));
        let itemsPerSlide;
        if (screenWidth <= 425) {
            itemsPerSlide = 2;
        }
        else if (screenWidth <= 768) {
            itemsPerSlide = 4;
        }
        else {
            movies.forEach(movie => movie.style.width = '');
            itemsPerSlide = 6;
        }

        movies.forEach((movie, index) => {
            movie.style.display = index < itemsPerSlide ? 'block' : 'none';
        });
    });
}
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
                            <div class="col-xl-2 col-lg-2 col-md-3 col-sm-4 col-6 mb-3">
                            <div class="movie-card">
                                        <img src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] }}" alt="{{ $movie['title'] }}" class="movie-poster">
                                        <div class="movie-info">
                                            <div class="movie-details">
                                                <div class="movie-rating-title">
                                                    <div class="movie-rating">
                                                        <i class="fa fa-star"></i>
                                                        <span class="rating">{{ number_format($movie['vote_average'], 1) }}</span>
                                                    </div>
                                                    <h2 class="movie-title">{{ $movie['title'] }}</h2>
                                                </div>
                                                <div class="button-group">
                                                    <button class="watchlist-btn" onclick="window.location.href='{{ route('GetWatchlist') }}'">
                                                        <i class="fa fa-plus-circle"></i> Watchlist
                                                    </button>

                                                    <button class="trailer-btn" onclick="window.location.href='{{ route('MovieDetail', ['movieId' => $movie['id']]) }}'">
                                                        <i class="fa fa-info"></i> Info
                                                    </button>
                                                </div>

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
                                <div class="col-xl-2 col-lg-2 col-md-3 col-sm-4 col-6 mb-3">
                                    <div class="movie-card">
                                        <img src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] }}" alt="{{ $movie['title'] }}" class="movie-poster">
                                        <div class="movie-info">
                                            <div class="movie-details">
                                                <div class="movie-rating-title">
                                                    <div class="movie-rating">
                                                        <i class="fa fa-star"></i>
                                                        <span class="rating">{{ number_format($movie['vote_average'], 1) }}</span>
                                                    </div>
                                                    <h2 class="movie-title">{{ $movie['title'] }}</h2>
                                                </div>
                                                <div class="button-group">
                                                    <button class="watchlist-btn" onclick="window.location.href='{{ route('GetWatchlist') }}'">
                                                        <i class="fa fa-plus-circle"></i> Watchlist
                                                    </button>

                                                    <button class="trailer-btn" onclick="window.location.href='{{ route('MovieDetail', ['movieId' => $movie['id']]) }}'">
                                                        <i class="fa fa-info"></i> Info
                                                    </button>
                                                </div>

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
                                <div class="col-xl-2 col-lg-2 col-md-3 col-sm-4 col-6 mb-3">
                                    <div class="movie-card">
                                        <img src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] }}" alt="{{ $movie['title'] }}" class="movie-poster">
                                        <div class="movie-info">
                                            <div class="movie-details">
                                                <div class="movie-rating-title">
                                                    <div class="movie-rating">
                                                        <i class="fa fa-star"></i>
                                                        <span class="rating">{{ number_format($movie['vote_average'], 1) }}</span>
                                                    </div>
                                                    <h2 class="movie-title">{{ $movie['title'] }}</h2>
                                                </div>
                                                <div class="button-group">
                                                    <button class="watchlist-btn" onclick="window.location.href='{{ route('GetWatchlist') }}'">
                                                        <i class="fa fa-plus-circle"></i> Watchlist
                                                    </button>

                                                    <button class="trailer-btn" onclick="window.location.href='{{ route('MovieDetail', ['movieId' => $movie['id']]) }}'">
                                                        <i class="fa fa-info"></i> Info
                                                    </button>
                                                </div>

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
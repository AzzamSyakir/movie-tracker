<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Tracker</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <style>
        .movie-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            display: flex;  
            flex-direction: column;
        }
        .movie-card img {
            width: 100%;
            height: auto;
            border-bottom: 1px solid #ddd;
        }
        .movie-info {
            padding: 15px;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }
        .movie-title {
            font-size: 1.5rem;
            margin-bottom: 10px;
        }
        .movie-overview {
            font-size: 1rem;
            color: #555;
            margin-bottom: 10px;
            flex-grow: 1;
        }
        .movie-rating {
            font-weight: bold;
        }
        .carousel-control-prev.disabled, 
        .carousel-control-next.disabled {
            pointer-events: none;
            opacity: 0.5;
        }
        .carousel-control-prev, 
        .carousel-control-next {
            width: 40px;
            height: 60px;
            background-color: rgba(255, 255, 255, 0.1); 
            border: 1px solid #fff; 
            border-radius: 5px; 
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .carousel-control-prev:hover,
        .carousel-control-next:hover {
            background-color: rgba(255, 255, 255, 0.2); 
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: transparent; 
            border-radius: 0; 
            width: 20px;
            height: 20px;
        }

    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Movie Tracker</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Movies</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container">
    <!-- Popular Movies Carousel -->
    <div id="popularMoviesCarousel" class="carousel slide mb-4" data-ride="carousel" data-interval="false">
        <h5>Popular Movies</h5>
        <div class="d-flex justify-content-between align-items-center position-relative">
        <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
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
                                            <p class="movie-rating">Rating: {{ $movie['vote_average'] }} / 10</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
            <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

    <!-- Now Playing Movies Carousel -->
    <div id="nowPlayingMoviesCarousel" class="carousel slide mb-4" data-ride="carousel" data-interval="false">
        <h5>Now Playing Movies</h5>
        <div class="d-flex justify-content-between align-items-center position-relative">
        <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
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
                                            <p class="movie-rating">Rating: {{ $movie['vote_average'] }} / 10</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
            <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

    <!-- Top Rated Movies Carousel -->
    <div id="topRatedMoviesCarousel" class="carousel slide mb-4" data-ride="carousel" data-interval="false">
        <h5>Top Rated</h5>
        <div class="d-flex justify-content-between align-items-center position-relative">
        <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
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
                                            <p class="movie-rating">Rating: {{ $movie['vote_average'] }} / 10</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
            <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

</div>


    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3 mt-4">
        <p>&copy; 2024 Movie Tracker. All rights reserved.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            function updateCarouselControls(carouselId) {
                var $carousel = $(carouselId);
                var $prev = $carousel.find('.carousel-control-prev');
                var $next = $carousel.find('.carousel-control-next');
                var $carouselInner = $carousel.find('.carousel-inner');
                var totalItems = $carouselInner.find('.carousel-item').length;
                var activeIndex = $carousel.find('.carousel-item.active').index();

                if (totalItems <= 1) {
                    $prev.addClass('disabled');
                    $next.addClass('disabled');
                } else {
                    if (activeIndex === 0) {
                        $prev.addClass('disabled');
                    } else {
                        $prev.removeClass('disabled');
                    }

                    if (activeIndex === totalItems - 1) {
                        $next.addClass('disabled');
                    } else {
                        $next.removeClass('disabled');
                    }
                }
            }

            $('#popularMoviesCarousel').on('slid.bs.carousel', function() {
                updateCarouselControls('#popularMoviesCarousel');
            });
            $('#nowPlayingMoviesCarousel').on('slid.bs.carousel', function() {
                updateCarouselControls('#nowPlayingMoviesCarousel');
            });
            $('#topRatedMoviesCarousel').on('slid.bs.carousel', function() {
                updateCarouselControls('#topRatedMoviesCarousel');
            });

            updateCarouselControls('#popularMoviesCarousel');
            updateCarouselControls('#nowPlayingMoviesCarousel');
            updateCarouselControls('#topRatedMoviesCarousel');
        });
    </script>
</body>
</html>

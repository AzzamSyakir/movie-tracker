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

.star-rating {
    color: #f5c518;
}

.fa-star,
.fa-star-half-alt {
    margin-right: 2px;
}

.info-btn {
    display: inline-block;
    padding: 5px 10px;
    background-color: #ffcc00;
    color: #000;
    border-radius: 5px;
    text-decoration: none;
    margin-top: 10px;
}

.info-btn:hover {
    background-color: #e6b800;
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
<div class="watchlist-info">
    <h1>Your Watchlist</h1>
    <p>by {{ $watchlist['name'] }} • Created {{ $watchlist['createdSince'] }}</p>
    <p>Your Watchlist helps you keep track of the movies you're interested in.</p>
    <p>Watchlist Info: {{ $watchlist['name'] }} - Created on {{ $watchlist['createdSince'] }}</p>
</div>

<div class="watchlist-body">
    @if (isset($message))
        <p>{{ $message }}</p>
    @else
        <ul class="movie-list">
            <div id="carouselExample" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    @foreach (array_chunk($watchlist['movies'], 6) as $index => $chunk)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                            <div class="row">
                                @foreach ($chunk as $movie)
                                    <div class="col-md-2 mb-3">
                                        <div class="movie-item">
                                            <img src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] }}" alt="{{ $movie['title'] }}">
                                            <div class="movie-info">
                                                <h3>{{ $movie['title'] }}</h3>
                                                <p>{{ $movie['release_date'] }}</p>
                                                <div class="star-rating">
                                                    @for ($i = 0; $i < floor($movie['vote_average'] / 2); $i++)
                                                        <i class="fa fa-star"></i>
                                                    @endfor
                                                    @if ($movie['vote_average'] % 2 != 0)
                                                        <i class="fa fa-star-half-alt"></i>
                                                    @endif
                                                </div>
                                                <p>{{ number_format($movie['vote_average'], 1) }}/10</p>
                                                <div class="button-group">
                                                    <a class="info-btn" href="/movie-details/{{ $movie['id'] }}">
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
                <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </ul>
    @endif
</div>
@endsection

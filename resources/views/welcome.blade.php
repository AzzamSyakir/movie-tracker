<!-- resources/views/home.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMDb Clone</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        .movie-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
        }
        .movie-item {
            text-align: center;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .movie-item img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }
        .movie-title {
            font-size: 18px;
            margin-top: 10px;
            font-weight: bold;
        }
        .movie-rating {
            margin-top: 5px;
            color: #ffa500;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Movies</a></li>
                <li><a href="#">TV Shows</a></li>
                <li><a href="#">Celebs</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section>
            <h1>Popular Movies</h1>
            <div class="movie-grid">
                @foreach($movies as $movie)
                <div class="movie-item">
                    <img src="{{ asset('images/' . $movie['poster']) }}" alt="{{ $movie['title'] }}">
                    <div class="movie-title">{{ $movie['title'] }}</div>
                    <div class="movie-rating">Rating: {{ $movie['rating'] }}</div>
                </div>
                @endforeach
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 IMDb Clone</p>
    </footer>
</body>
</html>

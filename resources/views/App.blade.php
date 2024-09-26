<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield(section: 'title', default: 'Default Title')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    @yield(section: 'custom-css')
    <style>
        /* Reset */
html, body {
    height: 100%;
    margin: 0;
}

body {
    display: flex;
    flex-direction: column;
}

/* Content */
.content {
    flex-grow: 1;
}

/* Footer */
footer {
    margin-top: auto;
    background-color: #1f1f1f;
    color: white;
    padding: 20px;
}

/* Dropdown Account */
.account-dropdown {
    position: relative;
    display: inline-block;
}

.account-dropdown-toggle {
    display: flex;
    align-items: center;
    background-color: transparent;
    color: #ffffff;
    border: none;
    padding: 10px;
    font-size: 14px;
    cursor: pointer;
    font-weight: bold;
    border-radius: 5px;
    transition: background-color 0.3s ease, color 0.3s ease;
}

.account-dropdown-toggle::after {
    display: none;
}

.account-dropdown-toggle i {
    font-size: 16px;
    margin-right: 8px;
}

.account-name {
    margin-left: 5px;
}

.account-dropdown-toggle:hover {
    background-color: #333;
    color: #ffffff;
}

.account-dropdown-menu {
    display: none;
    position: absolute;
    background-color: #1f1f1f;
    min-width: 160px;
    box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
    z-index: 1;
    border-radius: 4px;
}

.account-dropdown-menu a {
    color: #ffffff;
    padding: 10px 15px;
    text-decoration: none;
    display: block;
    font-weight: bold;
    white-space: nowrap;
}

.account-dropdown-menu a:hover {
    display: none;
}

.account-dropdown-menu.show {
    display: block;
}

/* Navbar */
body {
    margin: 0;
    font-family: Arial, sans-serif;
}

.navbar {
    position: relative;
    background-color: #2c3e50;
    padding: 10px 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.navbar-brand {
    color: #ecf0f1;
    font-size: 24px;
    font-weight: bold;
    text-decoration: none;
    transition: color 0.3s;
}

.navbar-brand:hover {
    color: #e74c3c;
}

.navbar {
    display: flex;
    justify-content: center;
    padding: 5px 20px;
    background-color: #1f1f1f;
    color: white;
}

.navbar-container {
    display: flex;
    align-items: center;
    width: 100%;
    max-width: 1200px;
    justify-content: space-between;
}

.navbar-brand {
    display: flex;
    align-items: center;
}

.logo {
    font-size: 20px;
    font-weight: bold;
    color: white;
    margin-right: 10px;
    text-decoration: none;
    background-color: transparent;
    border: 2px solid transparent;
    padding: 5px 10px;
    border-radius: 4px;
    transition: background-color 0.3s ease, border-color 0.3s ease, color 0.3s ease;
}

.logo:hover {
    text-decoration: none;
    background-color: rgba(255, 255, 255, 0.1);
    color: #ccc;
}

.menu-toggle {
    display: flex;
    align-items: center;
    background: none;
    border: none;
    color: #fff;
    font-size: 20px;
    cursor: pointer;
    margin-left: 10px;
    font-weight: bold;
}

.menu-text {
    margin-left: 5px;
    font-size: 14px;
    font-weight: bold;
}

/* Search */
.navbar-search {
    flex: 2;
    position: relative;
    display: flex;
    align-items: center;
    margin-left: 10px;
}

.search-dropdown-movie-overview {
    display: -webkit-box;
    webkit-line-clamp: 2; 
    webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: normal;
}

.navbar-search input {
    width: 100%;
    padding: 5px 40px 5px 10px;
    border: 1px solid #333;
    background-color: #fff;
    color: #000;
    border-radius: 4px;
    box-sizing: border-box;
}

.navbar-search button {
    position: absolute;
    right: 10px;
    background-color: transparent;
    border: none;
    color: #808080;
    cursor: pointer;
    font-size: 20px;
    transition: color 0.3s ease;
}

.navbar-search button:hover {
    color: #666;
}

/* Sign In */
.sign-in {
    margin-left: 20px;
}

.sign-in button {
    background-color: transparent;
    border: 2px solid transparent;
    color: #ffffff;
    padding: 10px 10px;
    cursor: pointer;
    font-size: 14px;
    border-radius: 5px;
    transition: background-color 0.3s ease, color 0.3s ease;
    font-weight: bold;
}

.sign-in button:hover {
    background-color: #333;
    color: #ffffff;
}

/* Watchlist */
.watchlist {
    display: flex;
    align-items: center;
    font-weight: bold;
    transition: background-color 0.3s ease;
    padding: 5px 10px;
    border-radius: 4px;
    margin-left: 10px;
}

.watchlist i {
    margin-right: 8px;
    color: #fff;
    font-size: 16px;
}

.watchlist button {
    background-color: transparent;
    border: 2px solid transparent;
    color: #ffffff;
    padding: 5px 10px;
    cursor: pointer;
    font-size: 14px;
    border-radius: 4px;
    transition: background-color 0.3s ease, color 0.3s ease;
    font-weight: bold;
}

.watchlist:hover {
    background-color: #333;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}

.watchlist:hover i {
    color: #fff;
}

/* Navbar Menu */
.navbar-menu {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: #333;
    color: #fff;
    padding: 20px;
    box-sizing: border-box;
    overflow-y: auto;
    transform: translateY(-100%);
    transition: transform 0.5s ease;
    z-index: 1000;
}

.navbar-menu.active {
    transform: translateY(0);
}

.menu-close {
    position: absolute;
    top: 20px;
    right: 20px;
    width: 50px;
    height: 50px;
    background-color: #fff;
    color: #333;
    border: none;
    border-radius: 50%;
    font-size: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: background-color 0.3s ease, color 0.3s ease;
}

.menu-close:hover {
    background-color: #ccc;
    color: #000;
}

.navbar-menu ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.navbar-menu li {
    margin: 20px 0;
}

.navbar-menu li a {
    color: #fff;
    text-decoration: none;
    display: block;
    font-weight: bold;
}

.navbar-menu li a:hover {
    color: grey;
}

/* Buttons */
button:focus {
    outline: none;
    box-shadow: none;
}

button {
    border: none;
    outline: none;
}

/* Media Queries */
@media (max-width: 768px) {
    .navbar-container {
        flex-direction: column;
        align-items: flex-start;
    }

    .navbar-search {
        margin-top: 10px;
        margin-right: 10px;
        width: 100%;
    }
}

/* Dropdown Results */
#dropdownResults {
    position: absolute;
    width: 100%;
    z-index: 1000;
    background-color: #2c2c2c;
    border: 1px solid #444;
    border-radius: 0.25rem;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    top: calc(100% + 5px);
}

.dropdown-item {
    padding: 10px;
    cursor: pointer;
    text-decoration: none;
    color: #ffffff;
}

.dropdown-item:hover {
    background-color: transparent;
    color: inherit;
}

    </style>
</head>
<body>
    <nav class="navbar">
        <div class="navbar-container">
            <div class="navbar-brand">
            <nav class="navbar">
                <a href="/" class="navbar-brand">Movie Addict</a>
            </nav>

            <button class="menu-toggle" onclick="toggleMenu()">
                    &#9776; <span class="menu-text">Menu</span>
                </button>
            </div>
            <div class="navbar-search">
                <input type="text" id="movieQuery" class="form-control" placeholder="Search Movies">
                <button type="button" id="searchButton">
                    <i class="fas fa-search"></i>
                </button>
                <div id="dropdownResults" class="search-dropdown-menu" style="display: none;"></div>
            </div>

            </div>
           <div class="watchlist">
                <i class="fas fa-bookmark"></i>
                <button onclick="window.location.href = '{{ route('GetWatchlist') }}'" type="button">Watchlist</button>
            </div>

            @guest
            <div class="sign-in">
                <form action="{{ route('SignInView') }}" method="GET">
                    <button type="submit">Sign in</button>
                </form>
            </div>
            @endguest
            @auth
            <div class="account-dropdown">
                <button class="account-dropdown-toggle">
                    <i class="fas fa-user"></i> <span class="account-name">{{Auth::user()->name}}</span>
                </button>
                <div class="account-dropdown-menu">
                    <a href="/account-settings">Account Settings</a>
                    <a href="{{route('GetWatchlist')}}">Watchlist</a>
                    <a href={{route('SignOutController')}}>Sign Out</a>
                </div>
            </div>


            @endauth
        </div>
    </nav>
    <div class="navbar-menu" id="navbar-menu">
        <button class="menu-close" onclick="toggleMenu()">&times;</button>
        <ul>
            <li><a href="#">Movies</a></li>
            <li><a href="#">TV Shows</a></li>
            <li><a href="#">Celebrities</a></li>
            <li><a href="#">News</a></li>
            <li><a href="{{route('GetWatchlist')}}">Watchlist</a></li>
        </ul>
    </div>

    <div class="content">
        @yield(section: 'content')
    </div>

    <footer class="bg-dark text-white py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-3">
                <h5 class="text-uppercase font-weight-bold">Movie Addict?</h5>
                <p class="small">A place to find and keep track of your favorite movies. Always stay updated with the latest films and interesting info about the world of cinema.</p>
            </div>
            <div class="col-md-4 mb-3 text-center">
                <h5 class="text-uppercase font-weight-bold">Follow Me</h5>
                <div class="d-flex justify-content-center align-items-center">
                    <a href="https://github.com/AzzamSyakir" class="text-white mx-2" target="_blank">
                        <i class="fab fa-github fa-2x"></i>
                    </a>
                    <a href="https://www.linkedin.com/in/azzamsyakir/" class="text-white mx-2" target="_blank">
                        <i class="fab fa-linkedin fa-2x"></i>
                    </a>
                    <a href="https://www.instagram.com/azmsykr_/" class="text-white mx-2" target="_blank">
                        <i class="fab fa-instagram fa-2x"></i>
                    </a>
                    <a href="https://x.com/assa_kussa" class="text-white mx-2" target="_blank">
                        <i class="fab fa-twitter fa-2x"></i>
                    </a>
                </div>
            </div>
            <div class="col-md-4 mb-3 text-right">
                <h5 class="text-uppercase font-weight-bold">Contact Me</h5>
                <a href="mailto:azzamsykir@gmail.com" class="btn btn-outline-light btn-sm">Contact Me</a>
            </div>
        </div>
        <hr class="border-gray-700">
        <div class="text-center small">
            <p class="mb-0">&copy; 2024 Movie Addict? All Rights Reserved.</p>
        </div>
    </div>
</footer>
<!-- javascript -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

@yield(section: 'custom-js')
<script>
    // Menu Toggle Function
    function toggleMenu() {
        const navbarMenu = document.getElementById('navbar-menu');
        navbarMenu.classList.toggle('active');
    }

    // Dropdown Menu Functionality
    document.addEventListener('DOMContentLoaded', function() {
        const dropdownToggle = document.querySelector('.account-dropdown-toggle');
        const dropdownMenu = document.querySelector('.account-dropdown-menu');

        dropdownToggle.addEventListener('click', function() {
            dropdownMenu.classList.toggle('show');
        });

        document.addEventListener('click', function(event) {
            if (!dropdownToggle.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.classList.remove('show');
            }
        });
    });

    // Movie Search Functionality
    function searchMovies(query) {
        if (query.length > 0) {
            $.ajax({
                url: '{{ route('SearchMovie', '') }}/' + encodeURIComponent(query),
                type: 'GET',
                success: function(data) {
                    $('#dropdownResults').empty();
                    if (data.length > 0) {
                        $('#dropdownResults').show();
                        let maxResults = 5;
                        let count = 0;

                        data.forEach(function(movie) {
                            if (count < maxResults) {
                                $('#dropdownResults').append(
                                    '<a class="dropdown-item" href="{{ route('MovieDetail', '') }}/' + movie.id + '">' +
                                        '<img src="https://image.tmdb.org/t/p/w500' + movie.poster_path + '" alt="' + movie.title + '" style="width: 50px; height: auto; margin-right: 10px;">' +
                                        movie.title + '<br>' +
                                        '<small class="search-dropdown-movie-overview">' + movie.overview + '</small>' +
                                    '</a>'
                                );
                            }
                            count++;
                        });

                        if (data.length > maxResults) {
                            $('#dropdownResults').append(
                                '<a href="{{route('FindMovie', '')}}/' + encodeURIComponent(query) + '" class="dropdown-item text-center text-primary">' +
                                    'See all results for "' + query + '"' +
                                '</a>'
                            );
                        }
                    } else {
                        $('#dropdownResults').hide();
                    }
                }
            });
        } else {
            $('#dropdownResults').hide();
        }
    }

    $(document).ready(function() {
        let debounceTimeout;

        $('#movieQuery').on('keyup', function() {
            var query = $(this).val();

            clearTimeout(debounceTimeout);
            debounceTimeout = setTimeout(function() {
                searchMovies(query);
            }, 300);
        });

        $('#searchButton').on('click', function() {
            var query = $('#movieQuery').val();
            searchMovies(query);
        });

        $(document).click(function(e) {
            if (!$(e.target).closest('#movieQuery, #dropdownResults').length) {
                $('#dropdownResults').hide();
            }
        });
    });
</script>
</body>
</html>
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
    html, body {
    height: 100%;
    display: flex;
    flex-direction: column;
    font-family: Arial, sans-serif;
}

body {
    flex-grow: 1;
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
    text-align: center;
}

/* Navbar */
.navbar {
    position: relative;
    display: flex;
    justify-content: space-between;
    padding: 5px;
    background-color: #1f1f1f;
    color: white;
    align-items: center;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    flex-wrap: nowrap;
}

.navbar-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100%;
    max-width: 1200px;
}

.navbar-brand, .navbar-title a {
    color: #fff;
    text-decoration: none;
    font-weight: bold;
}

.navbar-brand {
    display: flex;
    align-items: center;
}

.navbar-title {
    margin-right: 10px;
    padding: 5px 10px;
    border-radius: 4px;
    transition: background-color 0.3s, color 0.3s;
}

.navbar-title:hover, .logo:hover {
    background-color: rgba(255, 255, 255, 0.1);
    color: #ccc;
}

.logo {
    font-size: 15px;
    margin-right: 10px;
}

.menu-toggle {
    display: flex;
    align-items: center;
    background: none;
    border: none;
    color: #fff;
    font-size: 15px;
    cursor: pointer;
    margin-left: 10px;
    font-weight: bold;
}

.menu-text {
    margin-left: 5px;
    font-size: 14px;
    font-weight: bold;
}

/* Dropdown Account */
.account-dropdown {
    position: relative;
    display: inline-block;
    margin-right: 20px;
}

.account-dropdown-toggle {
    display: flex;
    align-items: center;
    background-color: transparent;
    color: #ffffff;
    border: none;
    padding: 10px;
    font-size: 15px;
    cursor: pointer;
    font-weight: bold;
    border-radius: 5px;
    transition: background-color 0.3s, color 0.3s;
}

.account-dropdown-toggle i {
    font-size: 15px;
    margin-right: 8px;
}

.account-dropdown-toggle:hover {
    background-color: #333;
}

.account-dropdown-menu {
    display: none;
    position: absolute;
    background-color: #1f1f1f;
    min-width: 160px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
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

.account-dropdown-menu.show {
    display: block;
}

/* Search */
.navbar-search {
    flex-grow: 1;
    position: relative;
    display: flex;
    align-items: center;
}

.navbar-search input {
    width: 100%;
    padding: 5px 40px 5px 10px;
    border: 1px solid #333;
    background-color: #fff;
    border-radius: 4px;
    box-sizing: border-box;
}

.navbar-search button {
    position: absolute;
    right: 10px;
    background-color: transparent;
    border: none;
    color: #808080;
    font-size: 15px;
    cursor: pointer;
    transition: color 0.3s;
}

.navbar-search button:hover {
    color: #666;
}

/* Sign In */
.sign-in button {
    background-color: transparent;
    border: 2px solid transparent;
    color: #ffffff;
    padding: 10px;
    cursor: pointer;
    font-size: 14px;
    border-radius: 5px;
    transition: background-color 0.3s, color 0.3s;
    font-weight: bold;
}

.sign-in button:hover {
    background-color: #333;
}

/* Watchlist */
.watchlist {
    display: flex;
    align-items: center;
    font-weight: bold;
    padding: 5px 10px;
    border-radius: 4px;
    margin-left: 10px;
    transition: background-color 0.3s;
}
.watchlist button {
    background-color: transparent;
    border: 2px solid transparent;
    color: #ffffff;
    padding: 5px 10px;
    cursor: pointer;
    font-size: 14px;
    border-radius: 4px;
    transition: background-color 0.3s, color 0.3s;
}

.watchlist:hover {
    background-color: #333;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
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
    transform: translateY(-100%);
    transition: transform 0.5s;
    z-index: 1000;
    overflow-y: auto;
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
    border-radius: 50%;
    font-size: 24px;
    cursor: pointer;
}

.menu-close:hover {
    background-color: #ccc;
}

.navbar-menu ul {
    list-style: none;
    padding: 0;
}

.navbar-menu li {
    margin: 20px 0;
}

.navbar-menu li a {
    color: #fff;
    font-weight: bold;
}

/* Dropdown Results */
#dropdownResults {
    position: absolute;
    width: 100%;
    background-color: #2c2c2c;
    border: 1px solid #444;
    border-radius: 0.25rem;
    top: calc(100% + 5px);
    z-index: 1000;
}

.dropdown-item {
    padding: 10px;
    color: #ffffff;
}

.dropdown-item:hover {
    background-color: transparent;
}

/* Buttons */
button:focus {
    outline: none;
}

#closeIcon {
        display: none;
    }

/* Media Queries */

/* Laptop L (1440px) */
@media (max-width: 1440px) {
    .navbar-search input {
        font-size: 14px;
    }

    .sign-in button {
        font-size: 14px;
        white-space: nowrap;
    }

    .watchlist button {
        font-size: 15px;
    }
}

/* Laptop (1024px) */
@media (max-width: 1024px) {
    /* navbar css section */
    .navbar-container {
        max-width: 90%;
    }
    .navbar-search input {
        font-size: 13px;
    }

    /* button css section */

    .sign-in button {
        font-size: 14px;
    }

    .watchlist button {
        font-size: 15px;
    }
}

/* Tablet (768px) */
@media (max-width: 768px) {
     .navbar-title {
        order: 2;
        margin-right: auto;
    }

    .menu-text {
        display: none;
    }

    .watchlist {
        display: none;
    }

    .navbar-search {
        margin-top: 10px;
        width: 100%;
    }

    .navbar-search input {
        font-size: 12px;
        margin-bottom: 10px;
    }

    .menu-toggle {
        order: 1;
        margin-left: auto;
        font-size: 14px;
    }

    .account-dropdown-toggle {
        padding: 8px;
        font-size: 13px;
    }

    .watchlist button {
        font-size: 11px;
        padding: 8px;
    }
    .navbar-search button {
        margin-bottom: 10px;
    }
}


@media (max-width: 599px) {
    .navbar-search input {
        display: none;
    }

    .navbar-search.active {
        display: block;
        position: fixed;
        top: 0;
        left: 0;
        height: 60px;
        z-index: 1000;
        background-color: white;
        padding: 0;
        box-sizing: border-box;
        margin-top: 0;
        }

    .navbar-search input {
        width: calc(100% - 40px);
        height: 100%;
        border: none;
        padding: 10px;
        box-sizing: border-box;
    }

    .navbar-search.active #closeIcon {
        position: absolute;
        top: 10px;
        right: 10px;
        z-index: 1001;
        height: 38px;
    }
    #searchIcon {
        display: block;
        position: absolute;
        z-index: 1001;
    }
    .navbar-search.active #searchIcon {
        display: none;
    }
}

/* Mobile L (425px) */
@media (max-width: 425px) {
    .navbar-container {
        padding: 0 10px;
    }
    .navbar-search button {
        margin-bottom: 10px;
    }
   

    .account-dropdown-toggle {
        padding: 5px;
        font-size: 12px;
    }

    .watchlist button {
        font-size: 10px;
        padding: 5px;
    }

    .navbar-brand {
        font-size: 12px;
    }
}

/* Mobile M (375px) */
@media (max-width: 375px) {
    .navbar-container {
        flex-direction: column;
        align-items: flex-start;
        padding: 0 8px;
    }

    .navbar-search input {
        font-size: 10px;
    }

    .menu-toggle {
        font-size: 11px;
    }

    .account-dropdown-toggle {
        padding: 5px;
        font-size: 11px;
    }

    .watchlist button {
        font-size: 9px;
        padding: 5px;
    }

    .navbar-brand {
        font-size: 15px;
        padding: 0;
        margin-top: 12px;
    }
    #searchIcon {
        margin-bottom: 48px;
    }
}

/* Mobile S (320px) */
@media (max-width: 320px) {
    .navbar-container {
        flex-direction: column;
        align-items: flex-start;
        padding: 0 5px;
    }

    .navbar-search input {
        font-size: 9px;
    }

    .menu-toggle {
        font-size: 10px;
    }

    .account-dropdown-toggle {
        padding: 5px;
        font-size: 10px;
    }

    .watchlist button {
        font-size: 8px;
        padding: 5px;
    }

    .navbar-brand {
        font-size: 15px;
    }
}
</style>
</head>
<body>
    <nav class="navbar">
        <div class="navbar-container">
            <div class="navbar-brand">
            <nav class="navbar-title">
                <a href="/">Movie Addict</a>
            </nav>

            <button class="menu-toggle" onclick="tooglemenu()">
                    &#9776; <span class="menu-text">Menu</span>
                </button>
            </div>
            <div class="navbar-search">
            <input type="text" id="movieQuery" class="form-control" placeholder="Search Movies">
            <button type="SearchIcon" id="searchIcon">
                <i class="fas fa-search"></i>
            </button>
            <button type="CloseIcon" id="closeIcon">
                <i class="fas fa-times"></i>
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
                    <a href="{{route('AccountSettingView')}}">Account Settings</a>
                    <a href="{{route('GetWatchlist')}}">Watchlist</a>
                    <a href={{route('SignOutController')}}>Sign Out</a>
                </div>
            </div>


            @endauth
        </div>
    </nav>
    <div class="navbar-menu" id="navbar-menu">
        <button class="menu-close" onclick="tooglemenu()">&times;</button>
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
     function tooglemenu() {
            const navbarMenu = document.getElementById('navbar-menu');
            navbarMenu.classList.toggle('active');
            }
    document.addEventListener('DOMContentLoaded', function() {
        const searchButton = document.getElementById('searchButton');
        const searchInput = document.getElementById('movieQuery');
        const navbarSearch = document.querySelector('.navbar-search');
        const searchIcon = document.getElementById('searchIcon');
        const closeIcon = document.getElementById('closeIcon');
        const dropdownToggle = document.querySelector('.account-dropdown-toggle');
        const dropdownMenu = document.querySelector('.account-dropdown-menu');
        const accountName = document.querySelector('.account-name');

        function openSearch() {
            if (window.innerWidth <= 599) {
                navbarSearch.classList.add('active');
                searchInput.style.display = 'block';
                closeIcon.style.display = 'block';
                searchIcon.style.display = 'none';
                searchInput.focus();
            } else {
                redirectToFindMovies();
            }
        }

        function closeSearch() {
            if (window.innerWidth <= 599) {
                navbarSearch.classList.remove('active');
                searchInput.style.display = 'none';
                closeIcon.style.display = 'none';
                searchIcon.style.display = 'block';
            }
        }

        if (searchIcon) {
        searchIcon.addEventListener('click', openSearch);
        }

        if (closeIcon) {
            closeIcon.addEventListener('click', closeSearch);
        }

        document.addEventListener('click', function(e) {
            if (window.innerWidth <= 599 && !navbarSearch.contains(e.target)) {
                closeSearch();
            }
        });

            window.addEventListener('resize', function() {
                if (window.innerWidth > 599) {
                    searchInput.style.display = 'block';
                    closeIcon.style.display = 'none';
                    searchIcon.style.display = 'block';
                } else {
                    searchInput.style.display = 'none';
                    closeIcon.style.display = 'none';
                    searchIcon.style.display = 'block';  
                        }
            });

                document.addEventListener('click', function(event) {
                    if (dropdownToggle && dropdownMenu) {
                        dropdownToggle.addEventListener('click', function() {
                            dropdownMenu.classList.toggle('show');
                        });

                        document.addEventListener('click', function(event) {
                            if (!dropdownToggle.contains(event.target) && !dropdownMenu.contains(event.target)) {
                                dropdownMenu.classList.remove('show');
                            }
                        });
                    }
                });
                });
    


        if (accountName && accountName.textContent.length > 13) {
            accountName.textContent = accountName.textContent.substring(0, 13);
        }

        function redirectToFindMovies() {
            var query = document.getElementById('movieQuery').value;

            if (query.length > 0) {
                window.location.href = '{{ route('FindMovie', '') }}/' + encodeURIComponent(query);
            } else {
                alert("Please enter a movie name");
            }
        }

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
    });
</script>
</body>
</html>
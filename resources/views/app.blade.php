<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield(section: 'title', default: 'Default Title')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    @yield(section: 'custom-css')
    <style>
    body {
        margin: 0;
        font-family: Arial, sans-serif;
    }
    .navbar {
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

    .navbar-search {
        flex: 2;
        position: relative;
        display: flex;
        align-items: center;
        margin-left: 10px;
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

    button:focus {
        outline: none;
        box-shadow: none;
    }

    button {
        border: none;
        outline: none;
    }

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
                <input type="text" placeholder="Search Movies">
                <button type="button">
                    <i class="fas fa-search"></i>
                </button>
            </div>
            <div class="watchlist">
                <i class="fas fa-bookmark"></i>
                <button type="button">Watchlist</button>
            </div>
            <div class="sign-in">
                <form action="{{ route(name: 'SignInView') }}" method="GET">
                    <button type="submit">Sign in</button>
                </form>
            </div>
        </div>
    </nav>
    <div class="navbar-menu" id="navbar-menu">
        <button class="menu-close" onclick="toggleMenu()">&times;</button>
        <ul>
            <li><a href="#">Movies</a></li>
            <li><a href="#">TV Shows</a></li>
            <li><a href="#">Celebrities</a></li>
            <li><a href="#">News</a></li>
            <li><a href="#">Watchlist</a></li>
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
                <p class="small">Tempat untuk menemukan dan melacak film favoritmu. Selalu update dengan film-film terbaru dan informasi menarik seputar dunia perfilman.</p>
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

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    @yield(section: 'custom-js')

    <script>
        function toggleMenu() {
            const navbarMenu = document.getElementById('navbar-menu');
            navbarMenu.classList.toggle('active');
        }
    </script>
</body>
</html>

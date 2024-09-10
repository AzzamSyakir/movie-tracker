<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.4/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .loading-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.8);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }
    </style>
</head>
<body>
<div id="loading" class="loading-overlay">
    <div class="spinner-border text-primary" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>

<div class="login-container">
    <h1 class="text-2xl font-bold mb-6 text-center">Sign up</h1>
    <form method="POST" action="{{ route('SignUpController') }}" onsubmit="showLoading()">
        @csrf
        <div class="relative mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" id="email" name="email" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
        </div>
        <div class="relative mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" id="password" name="password" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            <a href="#" class="absolute top-1 right-0 text-sm forgot-password">Forgot Password?</a>
        </div>
        <div class="mb-6">
            <button type="submit" class="w-full px-4 py-2 rounded-md hover:bg-gray-700 sign-in-button">Sign up</button>
        </div>
    </form>
</div>

<script>
    function showLoading() {
        document.getElementById('loading').style.display = 'flex';
    }
</script>

</body>
</html>
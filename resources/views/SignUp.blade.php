<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up Suka film</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.4/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #f3f4f6;
        }
        .SignUp-container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 360px;
            padding: 24px;
            position: relative;
        }
        .loading-spinner {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border: 4px solid rgba(0, 0, 0, 0.1);
            border-radius: 50%;
            border-top: 4px solid #000;
            width: 30px;
            height: 30px;
            animation: spin 1s linear infinite;
            z-index: 50;
        }
        .sign-up-button {
            background-color: #000000;
            color: #ffffff;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen p-4">
<div class="SignUp-container">
    <h1 class="text-2xl font-bold mb-6 text-center">Sign up</h1>
    <form id="signup-form" method="POST" action="{{ route('SignUpController') }}">
        @csrf
        <div class="relative mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" id="email" name="email" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
        </div>
        <div class="relative mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" id="password" name="password" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
        </div>
        <div class="mb-6">
            <button type="submit" class="w-full px-4 py-2 rounded-md hover:bg-gray-700 sign-up-button">Sign up</button>
        </div>
    </form>
    <div class="flex items-center mb-6">
            <input type="checkbox" id="remember" name="remember" class="h-4 w-4 text-black focus:ring-black border-gray-300 rounded">
            <label for="remember" class="ml-2 text-sm text-black checkbox-label">i'm at least 17 years old and accept the terms of Use</label>
        </div>
</div>

<div class="loading-spinner"></div>

<a id="redirect-link" href="{{ route('SignInView') }}" style="display: none;"></a>

<script>
    document.getElementById('signup-form').addEventListener('submit', function (event) {
        event.preventDefault();
        document.querySelector('.loading-spinner').style.display = 'block';
        
        setTimeout(function () {
            event.target.submit();
        }, 2000);

        setTimeout(function () {
            document.getElementById('redirect-link').click();
        }, 2500);
    });
</script>
</body>
</html>
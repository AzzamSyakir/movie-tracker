<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in Suka film</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.4/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #f3f4f6;
        }
        .Sign-In-container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 360px;
            padding: 24px;
            position: relative;
        }
        .google-icon {
            width: 24px;
            height: 24px;
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 48 48'%3E%3Cpath fill='%23ffc107' d='M43.611 20.083H42V20H24v8h11.303c-1.649 4.657-6.08 8-11.303 8c-6.627 0-12-5.373-12-12s5.373-12 12-12c3.059 0 5.842 1.154 7.961 3.039l5.657-5.657C34.046 6.053 29.268 4 24 4C12.955 4 4 12.955 4 24s8.955 20 20 20s20-8.955 20-20c0-1.341-.138-2.65-.389-3.917'/%3E%3Cpath fill='%23ff3d00' d='m6.306 14.691l6.571 4.819C14.655 15.108 18.961 12 24 12c3.059 0 5.842 1.154 7.961 3.039l5.657-5.657C34.046 6.053 29.268 4 24 4C16.318 4 9.656 8.337 6.306 14.691'/%3E%3Cpath fill='%234caf50' d='M24 44c5.166 0 9.86-1.977 13.409-5.192l-6.19-5.238A11.9 11.9 0 0 1 24 36c-5.202 0-9.619-3.317-11.283-7.946l-6.522 5.025C9.505 39.556 16.227 44 24 44'/%3E%3Cpath fill='%231976d2' d='M43.611 20.083H42V20H24v8h11.303a12.04 12.04 0 0 1-4.087 5.571l.003-.002l6.19 5.238C36.971 39.205 44 34 44 24c0-1.341-.138-2.65-.389-3.917'/%3E%3C/svg%3E") no-repeat center;
            background-size: contain;
        }
        .facebook-icon {

            color: #4267b2;
            font-size: 24px;
        }
        .forgot-password, .details-link {
            color: #1d4ed8;
            font-size: 0.875rem;
        }
        .Sign-Up-link {
            margin-left: auto;
            color: #1d4ed8;
            font-size: 16px;
        }
        .checkbox-label {
            color: #000000;
        }
        .Sign-In-button {
            background-color: #000000;
            color: #ffffff;
        }
        .details-box {
            display: none;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #ffffff;
            border-radius: 4px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
            z-index: 10;
            padding: 16px;
            box-sizing: border-box;
            border: none;
        }
        .details-box .title {
            background-color: #f0f0f5;
            color: #000000;
            font-size: 0.875rem;
            font-weight: bold;
            padding: 8px;
            border-radius: 4px;
            margin-bottom: 12px;
            width: calc(100% + 32px);
            margin-left: -16px;
            margin-top: -16px;
        }
        .details-box .content {
            background-color: #ffffff;
            color: #000000;
            font-size: 0.75rem;
            padding: 8px;
            border-radius: 4px;
        }
        .details-box .close-btn {
            position: absolute;
            top: 5px;
            right: 15px;
            background: none;
            border: none;
            font-size: 18px;
            color: #000000;
            cursor: pointer;
            outline: none;
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen p-4">
<div class="Sign-In-container">
    <h1 class="text-2xl font-bold mb-6 text-center">Sign in</h1>

    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    <form method="POST" action="{{ route('SignInController') }}">
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
        <div class="flex items-center mb-6">
            <input type="checkbox" id="remember" name="remember" class="h-4 w-4 text-black focus:ring-black border-gray-300 rounded">
            <label for="remember" class="ml-2 text-sm text-black checkbox-label">Remember me</label>
            <a href="#" onclick="toggleDetails()" class="ml-2 text-sm text-gray-500 details-link">Details</a>
        </div>
        <div class="details-box">
            <button type="button" class="close-btn" onclick="toggleDetails()">×</button>
            <div class="title">"Remember me" Checkbox</div>
            <div class="content">
                <p>Choosing "Remember me" reduces the number of times you're asked to Sign-In on this device.</p>
                <p class="mt-2">To keep your account secure, use this option only on your personal devices.</p>
            </div>
        </div>
        <div class="mb-6">
            <button type="submit" class="w-full px-4 py-2 rounded-md hover:bg-gray-700 Sign-In-button">Sign in</button>
        </div>
    </form>

    <div class="flex items-center justify-center space-x-4">
        <a href="#" class="flex items-center justify-center w-full bg-white border border-gray-300 px-4 py-2 rounded-md hover:bg-gray-100 space-x-2">
            <i class="google-icon"></i>
            <span>Google</span>
        </a>
        <a href="#" class="flex items-center justify-center w-full bg-white border border-gray-300 px-4 py-2 rounded-md hover:bg-gray-100 space-x-2">
            <i class="fab fa-facebook-f facebook-icon"></i>
            <span>Facebook</span>
        </a>
    </div>
    <div style="margin-top: 20px;">
        Don't have an account? <a href="{{ route('SignUpView') }}" class="ml-2 text-sm text-gray-500 Sign-Up-link">Sign up</a>
    </div>
</div>
    <script>
        function toggleDetails() {
            const detailsBox = document.querySelector('.details-box');
            detailsBox.style.display = detailsBox.style.display === 'block' ? 'none' : 'block';
        }
    </script>
</body>
</html>
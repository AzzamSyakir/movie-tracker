<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.4/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .checkbox-label {
            color: #000000;
        }
        .signUp-button {
            background-color: #000000;
            color: #ffffff;
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
        .notification {
            display: none;
            background-color: #ff6f00;
            color: white;
            padding: 10px 20px;
            border-radius: 4px;
            margin-bottom: 10px;
            position: relative;
            animation: fadeIn 0.5s;
        }
        .notification.show {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .notification button {
            background: none;
            border: none;
            font-size: 16px;
            cursor: pointer;
            color: white;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen p-4">
<div id="loading" class="loading-overlay">
    <div class="spinner-border text-primary" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>
<div class="SignUp-container">
    <h1 class="text-2xl font-bold mb-6 text-center">Sign up</h1>

    <div id="notifications" class="mb-4"></div>

    <form method="POST" action="{{ route('SignUpController') }}" onsubmit="return validateForm()">
        @csrf
        <div class="relative mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" id="email" name="email" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
        </div>
        <div class="relative mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" id="password" name="password" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
        </div>
        <div class="flex items-center mb-6">
            <input type="checkbox" id="remember" name="remember" class="h-4 w-4 text-black focus:ring-black border-gray-300 rounded">
            <label for="remember" class="ml-2 text-sm text-black checkbox-label">I'm at least 17 years old and accept the Terms Of Use</label>
        </div>
        <div class="mb-6">
            <button type="submit" class="w-full px-4 py-2 rounded-md hover:bg-gray-700 signUp-button">Sign up</button>
        </div>
    </form>
</div>

<script>
    function showLoading() {
        document.getElementById('loading').style.display = 'flex';
    }

    function validateForm() {
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        const remember = document.getElementById('remember').checked;
        const notifications = document.getElementById('notifications');
        notifications.innerHTML = '';

        let isValid = true;

        if (!email) {
            showNotification('Please complete your email.');
            isValid = false;
        }

        if (!password) {
            showNotification('Please complete your password.');
            isValid = false;
        }

        if (!remember) {
            showNotification('Please accept the Terms of Use.');
            isValid = false;
        }

        if (isValid) {
            showLoading();
        }

        return isValid;
    }

    function showNotification(message) {
        const notifications = document.getElementById('notifications');
        const notification = document.createElement('div');
        notification.className = 'notification show';
        notification.innerHTML = `${message} <button onclick="this.parentElement.style.display='none';">&times;</button>`;
        notifications.appendChild(notification);
    }
</script>

</body>
</html>
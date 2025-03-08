@extends('App')

@section('title', 'Account Settings')

@section('custom-css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .settings-container {
            display: flex;
            flex-direction: column;
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        }

        h3 {
            font-size: 1.8rem;
            font-weight: 500;
            margin-bottom: 20px;
            text-align: center;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            font-size: 1rem;
            color: #444;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus {
            border-color: #1f72e8;
            outline: none;
        }

        .form-group .password-input {
            position: relative;
            display: flex;
            align-items: center;
        }

        .form-group .password-input input {
            flex-grow: 1;
        }

        .form-group .password-input .toggle-password {
            position: absolute;
            right: 10px;
            cursor: pointer;
            color: #aaa;
        }

        .form-group button {
            padding: 10px 0;
            width: 100%;
            background-color: #1f72e8;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }

        .form-group button:hover {
            background-color: #1558b0;
        }

        .error {
            color: red;
            font-size: 12px;
            margin-top: 5px;
        }

        .disabled-input {
            cursor: not-allowed;
            background-color: #f5f5f5;
        }

        .disabled-input::placeholder {
            color: #aaa;
        }

        .error-message {
            color: red;
            background-color: #f8d7da;
            border: 1px solid red;
            padding: 10px;
            margin-top: 10px;
            display: none;
        }

        .success-message {
            color: green;
            background-color: #d4edda;
            border: 1px solid green;
            padding: 10px;
            margin-top: 10px;
            display: none;
        }

        .info-icon,
        .success-icon {
            margin-right: 5px;
        }
    </style>
@endsection

@section('content')
    @if ($oauthProvider == 'local')
        <div class="settings-container">
            <h3>Account Settings</h3>

            <form action="{{ route('UpdateUser') }}" method="POST" onsubmit="return validateForm()">
                @csrf

                <div class="form-group">
                    <label for="name">Username</label>
                    <input type="text" id="name" name="name" value="{{ $user['name'] }}"
                        data-original-value="{{ $user['name'] }}" oninput="checkIfPasswordShouldBeEnabled()">
                    @error('name')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ $user['email'] }}"
                        data-original-value="{{ $user['email'] }}" oninput="checkIfPasswordShouldBeEnabled()">
                    @error('email')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="password-input" style="position: relative;">
                        <input type="password" id="password" name="password" placeholder="Enter new password"
                            class="disabled-input" disabled>
                        <span class="toggle-password" onclick="togglePasswordVisibility()">
                            <i class="fa fa-eye"></i>
                        </span>
                    </div>
                    @error('password')
                        <div class="error">
                            <i class="fa fa-info-circle info-icon"></i>{{ $message }}
                        </div>
                    @enderror
                </div>

                <button type="submit">Save changes</button>
            </form>

            <!-- Error and Success Message at the bottom -->
            <div id="error-message" class="error-message" style="display: none;">
                <i class="fa fa-info-circle info-icon"></i><span id="error-text"></span>
            </div>
            <div id="success-message" class="success-message" style="display: none;">
                <i class="fa fa-check-circle success-icon"></i><span id="success-text"></span>
            </div>

        </div>
    @else
        <div class="settings-container">
            <h3>Account Settings</h3>

            <form action="{{ route('UpdateUser') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="name">Username</label>
                    <input type="text" id="name" name="name" value="{{ $user['name'] }}"
                        data-original-value="{{ $user['name'] }}">
                    @error('name')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit">Save changes</button>
            </form>

            <!-- Error and Success Message at the bottom -->
            <div id="error-message" class="error-message" style="display: none;">
                <i class="fa fa-info-circle info-icon"></i><span id="error-text"></span>
            </div>
            <div id="success-message" class="success-message" style="display: none;">
                <i class="fa fa-check-circle success-icon"></i> <span id="success-text"></span>
            </div>
        </div>
    @endif
    <script>
        const oauth_provider = "{{ $oauthProvider }}";

        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.querySelector('.toggle-password i');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }

        function checkIfPasswordShouldBeEnabled() {
            const name = document.getElementById('name');
            const email = document.getElementById('email');
            const passwordInput = document.getElementById('password');

            const nameChanged = name.value !== name.dataset.originalValue;
            const emailChanged = email.value !== email.dataset.originalValue;

            if (nameChanged || emailChanged) {
                passwordInput.disabled = false;
                passwordInput.classList.remove('disabled-input');
            } else {
                passwordInput.disabled = true;
                passwordInput.classList.add('disabled-input');
            }
        }

        function validateForm() {
            const passwordInput = document.getElementById('password');

            if (!passwordInput.value) {
                alert('Password is required');
                return false;
            }
            return true;
        }

        document.addEventListener('DOMContentLoaded', function () {
            if (oauth_provider !== 'non local') {
                checkIfPasswordShouldBeEnabled();
            }
        });

        document.querySelector('form').addEventListener('submit', function (e) {
            e.preventDefault();
            const formData = new FormData(this);
            const successMessage = document.getElementById('success-message');
            const errorMessage = document.getElementById('error-message');
            const successText = document.getElementById('success-text');
            const errorText = document.getElementById('error-text');
            const time = 2000;

            fetch(this.action, {
                method: this.method,
                body: formData,
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        successText.innerHTML = data.success;
                        successMessage.style.display = 'block';
                        setTimeout(() => {
                            successMessage.style.display = 'none';
                        }, time);
                    } else if (data.error) {
                        const errorTextElement = document.getElementById('error-text');
                        if (typeof data.error === 'string') {
                            errorTextElement.innerHTML = data.error;
                        } else if (typeof data.error === 'object') {
                            const errorMessages = Object.values(data.error).flat().join(', ');
                            errorTextElement.innerHTML = errorMessages;
                        }
                        errorMessage.style.display = 'block';
                        setTimeout(() => {
                            errorMessage.style.display = 'none';
                        }, time);
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    </script>

@endsection
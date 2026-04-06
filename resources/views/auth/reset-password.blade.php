<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .auth-container {
            background-color: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 450px;
        }
        .auth-container h1 {
            text-align: center;
            margin-bottom: 25px;
            color: #1f2937;
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 6px;
            color: #374151;
        }
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px 12px;
            margin-bottom: 15px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 16px;
        }
        .error-message {
            color: #ef4444;
            font-size: 13px;
            margin-bottom: 10px;
        }
        button {
            background-color: #4f46e5;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }
        button:hover {
            background-color: #4338ca;
        }
    </style>
</head>
<body>
<div class="auth-container">
    <h1>Reset Password</h1>

    <form method="POST" action="{{ route('password.store') }}">
        @csrf
        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email -->
        <label for="email">Email</label>
        <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus>
        @error('email')
        <div class="error-message">{{ $message }}</div>
        @enderror

        <!-- Password -->
        <label for="password">Password</label>
        <input id="password" type="password" name="password" required>
        @error('password')
        <div class="error-message">{{ $message }}</div>
        @enderror

        <!-- Confirm Password -->
        <label for="password_confirmation">Confirm Password</label>
        <input id="password_confirmation" type="password" name="password_confirmation" required>
        @error('password_confirmation')
        <div class="error-message">{{ $message }}</div>
        @enderror

        <div style="margin-top: 20px;">
            <button type="submit">Reset Password</button>
        </div>
    </form>
</div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
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
            max-width: 500px;
            text-align: center;
        }
        p.info-text {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 20px;
        }
        .status-message {
            background-color: #d1fae5;
            color: #065f46;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 14px;
        }
        .actions {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            margin-top: 20px;
        }
        button.primary {
            background-color: #4f46e5;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            flex: 1;
        }
        button.primary:hover {
            background-color: #4338ca;
        }
        button.logout {
            background: none;
            border: none;
            color: #4f46e5;
            font-size: 14px;
            text-decoration: underline;
            cursor: pointer;
            flex: 1;
        }
        button.logout:hover {
            color: #4338ca;
        }
    </style>
</head>
<body>
<div class="auth-container">
    <p class="info-text">
        Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.
    </p>

    @if (session('status') == 'verification-link-sent')
        <div class="status-message">
            A new verification link has been sent to the email address you provided during registration.
        </div>
    @endif

    <div class="actions">
        <!-- Resend Verification Email -->
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="primary">Resend Verification Email</button>
        </form>

        <!-- Logout -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout">Log Out</button>
        </form>
    </div>
</div>
</body>
</html>

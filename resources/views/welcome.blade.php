<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #f9fafb, #e5e7eb); /* бело-серый фон */
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #1f2937; /* темный текст */
        }
        .welcome-container {
            background-color: #ffffff; /* белый контейнер */
            padding: 50px 40px;
            border-radius: 16px;
            text-align: center;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            max-width: 500px;
            width: 90%;
        }
        .welcome-container h1 {
            font-size: 36px;
            margin-bottom: 20px;
            color: #111827;
        }
        .welcome-container p {
            font-size: 16px;
            margin-bottom: 30px;
            color: #4b5563;
        }
        .auth-buttons {
            display: flex;
            justify-content: center;
        }
        .auth-buttons a {
            text-decoration: none;
            font-weight: bold;
            padding: 10px 25px;
            border-radius: 8px;
            transition: 0.3s;
            font-size: 16px;
            background-color: #f3f4f6; /* светло-серая кнопка */
            color: #1f2937; /* темный текст */
        }
        .auth-buttons a:hover {
            background-color: #e5e7eb;
        }
        @media (max-width: 400px) {
            .welcome-container h1 {
                font-size: 28px;
            }
            .auth-buttons {
                flex-direction: column;
            }
            .auth-buttons a {
                width: 100%;
            }
        }
    </style>
</head>
<body>
<div class="welcome-container">
    <h1>Welcome Back!</h1>
    <p>Please log in to continue to the application.</p>
    <div class="auth-buttons">
        <a href="{{ route('login') }}">Login</a>
    </div>
</div>
</body>
</html>

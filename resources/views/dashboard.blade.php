<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #4f46e5;
            color: white;
            padding: 20px;
            text-align: center;
            position: relative;
        }
        header form {
            position: absolute;
            top: 20px;
            right: 20px;
        }
        header button {
            background-color: #ef4444;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
        }
        main {
            padding: 40px 20px;
        }
        .card {
            background-color: white;
            max-width: 800px;
            margin: 0 auto;
            padding: 30px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            border-radius: 12px;
            text-align: center;
        }
        .card h2 {
            margin-top: 0;
            color: #1f2937;
        }
        .card p {
            color: #4b5563;
            font-size: 18px;
        }
    </style>
</head>
<body>
<header>
    <h1>Dashboard</h1>
    <nav style="position: absolute; top: 20px; left: 20px;">
        <a href="{{ route('ticket') }}" style="color: white; text-decoration: none; margin-right: 10px;">Create Ticket</a>
        <a href="{{ route('statistics') }}" style="color: white; text-decoration: none; margin-right: 10px;">Statistics</a>
        @role('manager')
            <a href="{{ route('admin.tickets.list') }}" style="color: white; text-decoration: none; margin-right: 10px;">Ticket List</a>
        @endrole
    </nav>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Log Out</button>
    </form>
</header>
<main>
    <div class="card">
        <h2>Welcome, {{ Auth::user()->name ?? 'User' }}!</h2>
        <p>You're logged in!</p>
    </div>
</main>
</body>
</html>

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
            max-width: 1200px;
            margin: 20px auto;
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

        #ticketsTable {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            font-family: Arial, sans-serif;
        }

        #ticketsTable th,
        #ticketsTable td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        #ticketsTable th {
            background-color: #4f46e5;
            color: white;
        }

        #ticketsTable tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #ticketsTable tr:hover {
            background-color: #e0e7ff;
        }

        #stats ul {
            list-style: none;
            padding: 0;
            margin: 20px 0 0 0;
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        #stats li {
            background-color: #e0e7ff;
            padding: 12px 20px;
            border-radius: 10px;
            font-size: 16px;
            color: #1f2937;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            min-width: 120px;
            text-align: center;
        }

        #stats li strong {
            display: block;
            font-size: 18px;
            margin-bottom: 4px;
            color: #4f46e5;
        }

        #period-select {
            padding: 8px 12px;
            border-radius: 8px;
            border: 1px solid #cbd5e1;
            background-color: white;
            color: #1f2937;
            font-size: 16px;
            outline: none;
            cursor: pointer;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        #period-select:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 2px rgba(79, 70, 229, 0.2);
        }

        #period-select option {
            padding: 8px;
            font-size: 16px;
            color: #1f2937;
            background-color: white;
        }
    </style>
</head>
<body>
<header>
    <h1>Admin tickets</h1>
    <nav style="position: absolute; top: 20px; left: 20px;">
        <a href="{{ route('ticket') }}" style="color: white; text-decoration: none;  margin-right: 15px;">Ticket</a>
        <a href="{{ route('dashboard') }}" style="color: white; text-decoration: none; margin-right: 15px;">Dashboard</a>
        @role('manager')
            <a href="{{ route('admin.tickets') }}" style="color: white; text-decoration: none; margin-right: 10px;">Tickets</a>
        @endrole
    </nav>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Log Out</button>
    </form>
</header>
<main>
    <div class="card">
        <h2>Tickets List</h2>
{{--        <label for="period-select">Select period:</label>--}}
{{--        <select id="period-select">--}}
{{--            <option value="day">Today</option>--}}
{{--            <option value="week" selected>Last 7 days</option>--}}
{{--            <option value="month">Last month</option>--}}
{{--        </select>--}}
        <table id="ticketsTable" style="width:100%; border-collapse: collapse; margin-top:10px;">
            <thead>
            <tr style="background-color: #4f46e5; color: white;">
                <th style="padding: 8px; border: 1px solid #ddd;">ID</th>
                <th style="padding: 8px; border: 1px solid #ddd;">Email</th>
                <th style="padding: 8px; border: 1px solid #ddd;">Subject</th>
                <th style="padding: 8px; border: 1px solid #ddd;">Status</th>
                <th style="padding: 8px; border: 1px solid #ddd;">Answer date</th>
                <th style="padding: 8px; border: 1px solid #ddd;">Created At</th>
            </tr>
            </thead>
            <tbody>
            @forelse($tickets as $ticket)
                <tr>
                    <td>{{ $ticket->id }}</td>
                    <td>{{ $ticket->email }}</td>
                    <td>{{ $ticket->subject }}</td>
                    <td>{{ $ticket->status }}</td>
                    <td>{{ $ticket->answered_at }}</td>
                    <td>{{ $ticket->created_at->format('Y-m-d H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align:center;">No tickets found</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</main>

<script>
    // const periodSelect = document.getElementById('period-select');
</script>
</body>
</html>

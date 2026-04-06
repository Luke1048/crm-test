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
    <h1>Statistics</h1>
    <nav style="position: absolute; top: 20px; left: 20px;">
        <a href="{{ route('dashboard') }}" style="color: white; text-decoration: none; margin-right: 15px;">Dashboard</a>
        <a href="{{ route('ticket') }}" style="color: white; text-decoration: none;">Ticket</a>
    </nav>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Log Out</button>
    </form>
</header>
<main>
    <div class="card">
        <h2>Tickets Statistics</h2>
        <label for="period-select">Select period:</label>
        <select id="period-select">
            <option value="day">Today</option>
            <option value="week" selected>Last 7 days</option>
            <option value="month">Last month</option>
        </select>
        <p id="stats">Loading...</p>
    </div>
</main>

<script>
    const periodSelect = document.getElementById('period-select');

    async function fetchStatistics(period = 'week') {
        try {
            const response = await fetch(`/api/tickets/statistics?period=${period}`, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            if (!response.ok) throw new Error('Error fetching statistics');

            const result = await response.json();
            const tickets = result.tickets;

            if (!tickets.length) {
                document.getElementById('stats').innerText = 'No tickets found.';
                return;
            }

            const statistics = tickets.reduce((acc, ticket) => {
                acc[ticket.status] = (acc[ticket.status] || 0) + 1;
                return acc;
            }, {});

            let html = '<ul>';
            for (const [status, count] of Object.entries(statistics)) {
                html += `<li><strong>${status}:</strong> ${count}</li>`;
            }
            html += '</ul>';

            document.getElementById('stats').innerHTML = html;

        } catch (error) {
            document.getElementById('stats').innerText = 'Failed to load statistics';
            console.error(error);
        }
    }

    fetchStatistics(periodSelect.value);

    periodSelect.addEventListener('change', () => {
        fetchStatistics(periodSelect.value);
    });
</script>
</body>
</html>

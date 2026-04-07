<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket #{{ $ticket->id }}</title>
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
        header a {
            color: white;
            text-decoration: none;
            margin-right: 15px;
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
        }
        .card h2 {
            margin-top: 0;
            color: #1f2937;
        }
        .card p {
            color: #4b5563;
            font-size: 16px;
            margin: 8px 0;
        }
        .card .label {
            font-weight: bold;
            color: #000000;
        }
        .files {
            margin-top: 15px;
        }
        .files li {
            margin-bottom: 6px;
        }
    </style>
</head>
<body>
<header>
    <h1>Ticket #{{ $ticket->id }}</h1>
    <nav style="position: absolute; top: 20px; left: 20px;">
        <a href="{{ route('admin.tickets.list') }}">Back to Tickets</a>
    </nav>
</header>
<main>
    <div class="card">
        <h2>Ticket Details</h2>

        <p><span class="label">ID:</span> {{ $ticket->id }}</p>
        <p><span class="label">Customer Email:</span> {{ $ticket->customer->email }}</p>
        <p><span class="label">Customer Phone:</span> {{ $ticket->customer->phone }}</p>
        <p><span class="label">Subject:</span> {{ $ticket->subject }}</p>
        <p><span class="label">Message:</span> {{ $ticket->message }}</p>
        <p><span class="label">Status:</span> {{ $ticket->status ?? 'N/A' }}</p>
        <p><span class="label">Answered At:</span> {{ $ticket->answered_at?->format('Y-m-d H:i') ?? 'Not answered' }}</p>
        <p><span class="label">Created At:</span> {{ $ticket->created_at?->format('Y-m-d H:i') ?? 'N/A' }}</p>
        <p><span class="label">Updated At:</span> {{ $ticket->updated_at?->format('Y-m-d H:i') ?? 'N/A' }}</p>

        @if($ticket->files->isNotEmpty())
            <div class="files">
                <span class="label">Attached Files:</span>
                <ul>
                    @foreach($ticket->files as $file)
                        <li>
                            <a href="{{ route('admin.tickets.file.download', $file) }}">
                                {{ $file->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</main>
</body>
</html>

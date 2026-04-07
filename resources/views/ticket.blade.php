<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Ticket</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            box-sizing: border-box;
        }

        /* Header */
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
            display: flex;
            justify-content: center;
        }

        /* Widget Card */
        .widget-container {
            width: 500px;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            text-align: center;
        }

        .widget-container h1 {
            margin-top: 0;
            color: #1f2937;
        }

        .widget-container p {
            color: #4b5563;
            font-size: 16px;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        input, textarea {
            padding: 0.5rem;
            font-size: 1rem;
            width: 100%;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        .file-input {
            background-color: #fff;
            cursor: pointer;
        }

        .file-input::-webkit-file-upload-button {
            padding: 0.5rem 1rem;
            margin-right: 0.5rem;
            border: none;
            background-color: #4f46e5;
            color: #fff;
            border-radius: 6px;
            cursor: pointer;
        }
        .file-input::-webkit-file-upload-button:hover {
            background-color: #3730a3;
        }

        #submit {
            padding: 0.6rem;
            font-size: 1rem;
            cursor: pointer;
            background: #4f46e5;
            color: #fff;
            border: none;
            border-radius: 6px;
            transition: background 0.2s;
        }

        #submit:hover {
            background: #3730a3;
        }

        .message {
            margin-top: 10px;
            font-weight: bold;
        }
        .message.error { color: red; }
        .message.success { color: green; }
    </style>
</head>
<body>
<header>
    <h1>Create Ticket</h1>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Log Out</button>
    </form>
</header>
<main>
    <div class="widget-container">
        <h1>Create Ticket</h1>
        <nav style="position: absolute; top: 20px; left: 20px;">
            <a href="{{ route('dashboard') }}" style="color: white; text-decoration: none; margin-right: 15px;">Dashboard</a>
            <a href="{{ route('statistics') }}" style="color: white; text-decoration: none; margin-right: 15px;">Statistics</a>
            @role('manager')
                <a href="{{ route('admin.tickets.list') }}" style="color: white; text-decoration: none; margin-right: 10px;">Ticket List</a>
            @endrole
        </nav>
        <p>Here you can create a ticket</p>
        <form id="widgetForm" enctype="multipart/form-data">
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="subject" placeholder="Subject" required>
            <textarea name="message" placeholder="Message" rows="4" required></textarea>
            <input type="file" name="attachments[]" id="attachments" class="file-input" multiple>
            <button id="submit" type="submit">Create</button>
            <div class="message" id="formMessage"></div>
        </form>
    </div>
</main>

<script>
    const form = document.getElementById('widgetForm');
    const messageDiv = document.getElementById('formMessage');

    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        messageDiv.textContent = '';
        messageDiv.className = 'message';

        const formData = new FormData(form);

        try {
            const response = await fetch('/api/tickets', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: formData
            });

            const result = await response.json();

            if (response.ok) {
                messageDiv.textContent = result.message || 'Ticket created successfully!';
                messageDiv.className = 'message success';
                form.reset();
            } else if (response.status === 422) {
                const errors = result.errors || {};
                messageDiv.textContent = Object.values(errors).flat().join(', ') || 'Validation error';
                messageDiv.className = 'message error';
            } else {
                messageDiv.textContent = result.message || 'Server error. Please try again';
                messageDiv.className = 'message error';
            }
        } catch (err) {
            messageDiv.textContent = err.message || 'Network error. Please check your connection';
            messageDiv.className = 'message error';
        }
    });
</script>
</body>
</html>

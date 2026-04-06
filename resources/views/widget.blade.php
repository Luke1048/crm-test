<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Feedback widget</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 1rem;
            background: #f9f9f9;
            box-sizing: border-box;
            display: flex;
            justify-content: center;
        }

        .widget-container {
            width: 500px;
            margin: 0 auto;
            background: #f9f9f9;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            width: 100%;
            max-width: 600px;
        }

        input, textarea {
            padding: 0.5rem;
            font-size: 1rem;
            width: 100%;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            padding: 0.5rem;
            font-size: 1rem;
            cursor: pointer;
            background: #007BFF;
            color: #fff;
            border: none;
            border-radius: 4px;
        }

        button:hover {
            background: #0056b3;
        }

        .message {
            margin-top: 0.5rem;
            font-weight: bold;
        }

        .file-input {
            padding: 0.5rem;
            font-size: 1rem;
            width: 100%;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #fff;
            cursor: pointer;
        }

        .file-input::-webkit-file-upload-button {
            padding: 0.5rem 1rem;
            margin-right: 0.5rem;
            border: none;
            background-color: #007BFF;
            color: #fff;
            border-radius: 4px;
            cursor: pointer;
        }

        .file-input::-webkit-file-upload-button:hover {
            background-color: #0056b3;
        }

        .error {
            color: red;
        }

        .success {
            color: green;
        }
    </style>
</head>
<body>

<div class="widget-container">
    <h1>Create Ticket</h1>
    <p>Here you can create a ticket</p>
    <form id="widgetForm" enctype="multipart/form-data">
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="subject" placeholder="Subject" required>
        <textarea name="message" placeholder="Message" rows="4" required></textarea>
        <input type="file" name="attachment" id="attachment" class="file-input">
        <button type="submit">Create</button>
        <div class="message" id="formMessage"></div>
    </form>
</div>

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

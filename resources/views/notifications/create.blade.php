<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Notification</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Create Notification</h1>

        <form action="{{ route('notifications.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="message" class="block font-bold">Message:</label>
                <input type="text" name="message" id="message" 
                       class="border-gray-300 p-2 w-full" required>
            </div>
            <div class="mb-4">
                <label for="user_id" class="block font-bold">User ID:</label>
                <input type="number" name="user_id" id="user_id" 
                       class="border-gray-300 p-2 w-full" required>
            </div>
            <button type="submit" class="bg-blue-500 text-white p-2 rounded">Create</button>
        </form>
    </div>
</body>
</html>

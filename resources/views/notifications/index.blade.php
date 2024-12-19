<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Notifications</h1>

        <!-- فیلتر اعلان‌ها -->
        <div class="filters mb-4">
            <form method="GET" action="{{ route('notifications.index') }}">
                <select name="status" class="border rounded p-2">
                    <option value="">All</option>
                    <option value="read" {{ request('status') === 'read' ? 'selected' : '' }}>Read</option>
                    <option value="unread" {{ request('status') === 'unread' ? 'selected' : '' }}>Unread</option>
                </select>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Filter</button>
            </form>
        </div>

        <!-- لیست اعلان‌ها -->
        <div id="notifications-list">
            @forelse ($notifications as $notification)
                <div class="p-4 bg-white shadow mb-4 rounded">
                    <p>{{ $notification->message }}</p>
                    <small class="text-gray-500">
                        {{ $notification->created_at->diffForHumans() }}
                        @if ($notification->read_at)
                            | Read at: {{ \Carbon\Carbon::parse($notification->read_at)->diffForHumans() }}
                        @else
                            | Not read yet
                        @endif
                    </small>
                    <div class="flex gap-4 mt-2">
                        <button onclick="markAsRead({{ $notification->id }})" class="text-green-500">Mark as Read</button>
                        <button onclick="deleteNotification({{ $notification->id }})" class="text-red-500">Delete</button>
                    </div>
                </div>
            @empty
                <p>No notifications available.</p>
            @endforelse
        </div>

        <!-- دکمه‌های صفحه‌بندی -->
        <div class="pagination mt-4 flex justify-between">
            @if ($notifications->previousPageUrl())
                <button onclick="fetchNotifications('{{ $notifications->previousPageUrl() }}')" class="bg-blue-500 text-white px-4 py-2 rounded">Previous</button>
            @endif

            @if ($notifications->nextPageUrl())
                <button onclick="fetchNotifications('{{ $notifications->nextPageUrl() }}')" class="bg-blue-500 text-white px-4 py-2 rounded">Next</button>
            @endif
        </div>
    </div>

    <!-- اسکریپت‌های جاوااسکریپت -->
    <script>
        function deleteNotification(id) {
            if (!confirm("Are you sure you want to delete this notification?")) return;

            fetch(`/api/notifications/${id}`, {
                method: 'DELETE',
                headers: {
                    'Authorization': 'Bearer KnO5nXIsyFdOLq6AtqNDjatu8v8YpUDs90mc2qPjs99kyFSEisIcL0oaDMf7',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.message === 'Notification deleted successfully') {
                    alert('Notification deleted.');
                    location.reload();
                } else {
                    alert('Failed to delete notification.');
                }
            })
            .catch(error => console.error('Error:', error));
        }

        function markAsRead(id) {
            fetch(`/api/notifications/${id}/mark-as-read`, {
                method: 'PATCH',
                headers: {
                    'Authorization': 'Bearer KnO5nXIsyFdOLq6AtqNDjatu8v8YpUDs90mc2qPjs99kyFSEisIcL0oaDMf7',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.message === 'Notification marked as read') {
                    alert('Notification marked as read.');
                    location.reload();
                } else {
                    alert('Failed to mark notification as read.');
                }
            })
            .catch(error => console.error('Error:', error));
        }
    </script>
</body>
</html>

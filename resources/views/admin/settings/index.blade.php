<!DOCTYPE html>
<html>
<head>
    <title>Admin Settings</title>
</head>
<body>
    <h1>Admin Settings</h1>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST">
    @csrf
    <label>Site Name:</label>
    <input type="text" name="site_name" value="{{ $settings['site_name'] ?? '' }}" required>
    <br>
    <label>Email:</label>
    <input type="email" name="email" value="{{ $settings['email'] ?? '' }}" required>
    <br>
    <label>Timezone:</label>
    <input type="text" name="timezone" value="{{ $settings['timezone'] ?? '' }}" required>
    <br>
    <button type="submit">Save Settings</button>
</form>

</body>
</html>

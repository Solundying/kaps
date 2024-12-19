<!DOCTYPE html>
<html>
<head>
    <title>Create New Tab</title>
</head>
<body>
    <h1>Create New Tab for {{ $page->title }}</h1>

    <form method="POST" action="{{ route('admin.tabs.store', $page->id) }}">
        @csrf
        <label>Name:</label>
        <input type="text" name="name" required><br>

        <label>Order:</label>
        <input type="number" name="order" required><br>

        <label>Is Active:</label>
        <select name="is_active">
            <option value="1">Yes</option>
            <option value="0">No</option>
        </select><br>

        <button type="submit">Save</button>
    </form>
</body>
</html>

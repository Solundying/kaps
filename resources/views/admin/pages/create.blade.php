<!DOCTYPE html>
<html>
<head>
    <title>Create Page</title>
</head>
<body>
    <h1>Create New Page</h1>
    <form method="POST" action="{{ route('admin.pages.store') }}">
        @csrf
        <label>Title:</label>
        <input type="text" name="title" required><br>

        <label>Slug:</label>
        <input type="text" name="slug" required><br>

        <label>Content:</label>
        <textarea name="content"></textarea><br>

        <label>Active:</label>
        <select name="is_active">
            <option value="1" selected>Yes</option>
            <option value="0">No</option>
        </select><br>

        <button type="submit">Save</button>
    </form>
</body>
</html>

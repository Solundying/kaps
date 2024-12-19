<!DOCTYPE html>
<html>
<head>
    <title>Edit Page</title>
</head>
<body>
    <h1>Edit Page: {{ $page->title }}</h1>
    <form method="POST" action="{{ route('admin.pages.update', $page->id) }}">
        @csrf
        @method('PUT')
        <label>Title:</label>
        <input type="text" name="title" value="{{ $page->title }}" required><br>

        <label>Slug:</label>
        <input type="text" name="slug" value="{{ $page->slug }}" required><br>

        <label>Content:</label>
        <textarea name="content">{{ $page->content }}</textarea><br>

        <label>Active:</label>
        <select name="is_active">
            <option value="1" {{ $page->is_active ? 'selected' : '' }}>Yes</option>
            <option value="0" {{ !$page->is_active ? 'selected' : '' }}>No</option>
        </select><br>

        <button type="submit">Save Changes</button>
    </form>
</body>
</html>

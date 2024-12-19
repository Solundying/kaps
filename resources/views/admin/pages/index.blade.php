<!DOCTYPE html>
<html>
<head>
    <title>Admin - Pages</title>
</head>
<body>
    <h1>Pages</h1>
    <a href="{{ route('admin.pages.create') }}">Create New Page</a>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Slug</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pages as $page)
                <tr>
                    <td>{{ $page->id }}</td>
                    <td>{{ $page->title }}</td>
                    <td>{{ $page->slug }}</td>
                    <td>
                        <a href="{{ route('admin.tabs', $page->id) }}">Manage Tabs</a>
                        <a href="{{ route('admin.pages.edit', $page->id) }}">Edit</a>
                        <form method="POST" action="{{ route('admin.pages.destroy', $page->id) }}" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

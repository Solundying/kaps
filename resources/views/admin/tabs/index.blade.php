<!DOCTYPE html>
<html>
<head>
    <title>Manage Tabs</title>
</head>
<body>
    <h1>Manage Tabs for {{ $page->title }}</h1>
    <a href="{{ route('admin.tabs.create', $page->id) }}">Create New Tab</a>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Order</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tabs as $tab)
                <tr>
                    <td>{{ $tab->id }}</td>
                    <td>{{ $tab->name }}</td>
                    <td>{{ $tab->order }}</td>
                    <td>{{ $tab->is_active ? 'Yes' : 'No' }}</td>
                    <td>
                        <a href="{{ route('admin.tabs.edit', $tab->id) }}">Edit</a>
                        <form method="POST" action="{{ route('admin.tabs.destroy', $tab->id) }}" style="display:inline;">
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

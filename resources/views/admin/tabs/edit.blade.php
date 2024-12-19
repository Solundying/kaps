<!DOCTYPE html>
<html>
<head>
    <title>Edit Tab</title>
</head>
<body>
    <h1>Edit Tab: {{ $tab->name }}</h1>
    <form method="POST" action="{{ route('admin.tabs.update', $tab->id) }}">
        @csrf
        @method('PUT')
        <label>Name:</label>
        <input type="text" name="name" value="{{ $tab->name }}" required><br>

        <label>Order:</label>
        <input type="number" name="order" value="{{ $tab->order }}" required><br>

        <label>Active:</label>
        <select name="is_active">
            <option value="1" {{ $tab->is_active ? 'selected' : '' }}>Yes</option>
            <option value="0" {{ !$tab->is_active ? 'selected' : '' }}>No</option>
        </select><br>

        <button type="submit">Save Changes</button>
    </form>
</body>
</html>

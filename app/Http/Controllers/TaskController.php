<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    // نمایش تمام وظایف کاربر
    public function index()
    {
        $tasks = Auth::user()->tasks; // دریافت وظایف مرتبط با کاربر
        return response()->json($tasks);
    }

    // ایجاد وظیفه جدید
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $task = Task::create([
            'title' => $validated['title'],
            'user_id' => Auth::id(), // ارتباط با کاربر
        ]);

        return response()->json($task, 201); // وضعیت 201 به‌معنای ایجاد موفق
    }

    // ویرایش وظیفه
    public function update(Request $request, $id)
    {
        $task = Task::where('id', $id)->where('user_id', Auth::id())->first();

        if (!$task) {
            return response()->json(['message' => 'Task not found or unauthorized'], 404);
        }

        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'status' => 'sometimes|in:pending,in-progress,completed',
        ]);

        $task->update($validated);

        return response()->json(['message' => 'Task updated successfully', 'task' => $task]);
    }

    // حذف وظیفه
    public function destroy($id)
    {
        $task = Task::where('id', $id)->where('user_id', Auth::id())->first();

        if (!$task) {
            return response()->json(['message' => 'Task not found or unauthorized'], 404);
        }

        $task->delete();

        return response()->json(['message' => 'Task deleted successfully']);
    }
}

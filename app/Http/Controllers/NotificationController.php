<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class NotificationController extends Controller
{
    // نمایش اعلان‌ها با قابلیت صفحه‌بندی و فیلتر
    public function index(Request $request)
    {
        \Log::info('User ID:', ['user_id' => Auth::id()]);
    
        $query = Notification::where('user_id', Auth::id());
    
        // فیلتر خوانده‌شده/خوانده‌نشده
        if ($request->has('status')) {
            if ($request->status === 'read') {
                $query->whereNotNull('read_at');
            } elseif ($request->status === 'unread') {
                $query->whereNull('read_at');
            }
        }
    
        // صفحه‌بندی
        $notifications = $query->orderBy('created_at', 'desc')->paginate(10);
    
        \Log::info('Notifications Retrieved:', ['notifications' => $notifications]);
    
        return view('notifications.index', compact('notifications'));
    }

    // ایجاد اعلان جدید
    public function store(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
        ]);

        $notification = Notification::create([
            'message' => $validated['message'],
            'user_id' => $validated['user_id'],
        ]);

        return response()->json([
            'message' => 'Notification created successfully',
            'notification' => $notification,
        ], 201);
    }

    // علامت‌گذاری اعلان به‌عنوان خوانده‌شده
    public function markAsRead($id)
    {
        \Log::info('Marking notification as read', ['id' => $id]);

        $notification = Notification::findOrFail($id);

        if ($notification->user_id !== Auth::id()) {
            \Log::error('Unauthorized access to notification', ['id' => $id, 'user_id' => Auth::id()]);
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $notification->update(['read_at' => now()]);

        \Log::info('Notification marked as read', ['id' => $id]);

        return response()->json([
            'message' => 'Notification marked as read',
            'notification' => $notification,
        ]);
    }

    // نمایش اعلان‌ها در قالب HTML
    public function show()
    {
        $notifications = Notification::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('notifications.index', compact('notifications'));
    }

    // ایجاد فرم برای ایجاد اعلان
    public function create()
    {
        return view('notifications.create');
    }

    // حذف یک اعلان
    public function destroy($id)
    {
        $notification = Notification::findOrFail($id);

        if ($notification->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $notification->delete();

        return response()->json(['message' => 'Notification deleted successfully']);
    }
}

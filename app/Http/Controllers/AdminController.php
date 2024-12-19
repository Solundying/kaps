<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    // نمایش داشبورد ادمین
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    // مدیریت کاربران (مثال)
    public function manageUsers()
    {
        $users = \App\Models\User::all(); // لیست تمام کاربران
        return view('admin.users.index', compact('users'));
    }

    // مدیریت تنظیمات
    public function settings()
    {
        $settings = \App\Models\Setting::all(); // تنظیمات سیستم
        return view('admin.settings.index', compact('settings'));
    }
}

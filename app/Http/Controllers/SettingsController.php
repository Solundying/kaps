<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class SettingsController extends Controller
{
    // نمایش صفحه تنظیمات
    public function index()
{
    $settings = Setting::all()->pluck('value', 'key')->toArray();

    // تنظیم مقادیر پیش‌فرض
    $settings = array_merge([
        'site_name' => 'Default Site Name',
        'email' => 'admin@example.com',
        'timezone' => 'UTC',
    ], $settings);

    return view('admin.settings.index', compact('settings'));
}

    // به‌روزرسانی تنظیمات
    public function update(Request $request)
{
    $validated = $request->validate([
        'site_name' => 'required|string|max:255',
        'email' => 'required|email',
        'timezone' => 'required|string',
    ]);

    // ذخیره تنظیمات
    Setting::updateOrCreate(['key' => 'site_name'], ['value' => $request->input('site_name')]);
    Setting::updateOrCreate(['key' => 'email'], ['value' => $request->input('email')]);
    Setting::updateOrCreate(['key' => 'timezone'], ['value' => $request->input('timezone')]);

    return redirect()->route('admin.settings')->with('success', 'Settings updated successfully!');
}

}

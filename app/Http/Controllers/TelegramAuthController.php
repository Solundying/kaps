<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class TelegramAuthController extends Controller
{
    public function login(Request $request)
    {
        // اعتبارسنجی داده‌های ورودی
        $validated = $request->validate([
            'telegram_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'username' => 'nullable|string|max:255', // نام کاربری تلگرام
        ]);

        // نقش پیش‌فرض برای کاربر (user)
        $roleId = Role::where('name', 'user')->first()->id;

        // پیدا کردن یا ایجاد کاربر
        $user = User::updateOrCreate(
            ['telegram_id' => $validated['telegram_id']], // شرط: پیدا کردن بر اساس telegram_id
            [
                'name' => $validated['name'],
                'email' => null, // ایمیل موقت
                'password' => null, // مقدار خالی برای پسورد
                'telegram_username' => $validated['username'] ?? null, // ذخیره نام کاربری تلگرام
                'role_id' => $roleId,
            ]
        );

        // تولید توکن API
        $user->generateApiToken();

        // بازگشت پاسخ
        return response()->json([
            'message' => 'User authenticated successfully',
            'user' => $user,
            'api_token' => $user->api_token,
        ]);
    }
}

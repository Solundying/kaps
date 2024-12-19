<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\TabController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TelegramAuthController;
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\NotificationController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// صفحه اصلی
Route::get('/', function () {
    return view('welcome');
});

// داشبورد
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// مدیریت پروفایل کاربران (دسترسی عمومی برای کاربران وارد شده)
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// مسیرهای مخصوص **سوپر ادمین**
Route::middleware(['auth', 'role:super_admin'])->group(function () {
    Route::get('/admin/settings', [SettingsController::class, 'index'])->name('admin.settings');
    Route::post('/admin/settings', [SettingsController::class, 'update'])->name('admin.settings.update');

    // مدیریت کاربران
    Route::get('/admin/users', [AdminController::class, 'manageUsers'])->name('admin.users');
});

// مسیرهای مخصوص **ادمین** و **سوپر ادمین**
Route::middleware(['auth', 'role:admin'])->group(function () {
    // مسیرهای مدیریت صفحات
    Route::get('/admin/pages', [PageController::class, 'adminIndex'])->name('admin.pages');
    Route::get('/admin/pages/create', [PageController::class, 'create'])->name('admin.pages.create');
    Route::post('/admin/pages', [PageController::class, 'adminStore'])->name('admin.pages.store');
    Route::get('/admin/pages/{page}/edit', [PageController::class, 'edit'])->name('admin.pages.edit');
    Route::put('/admin/pages/{page}', [PageController::class, 'adminUpdate'])->name('admin.pages.update');
    Route::delete('/admin/pages/{page}', [PageController::class, 'destroy'])->name('admin.pages.destroy');

    // مسیرهای مدیریت تب‌ها
    Route::get('/admin/pages/{page}/tabs', [TabController::class, 'adminIndex'])->name('admin.tabs');
    Route::get('/admin/pages/{page}/tabs/create', [TabController::class, 'create'])->name('admin.tabs.create');
    Route::post('/admin/pages/{page}/tabs', [TabController::class, 'store'])->name('admin.tabs.store');
    Route::get('/admin/tabs/{tab}/edit', [TabController::class, 'edit'])->name('admin.tabs.edit');
    Route::put('/admin/tabs/{tab}', [TabController::class, 'update'])->name('admin.tabs.update');
    Route::delete('/admin/tabs/{tab}', [TabController::class, 'destroy'])->name('admin.tabs.destroy');
});

// بخش مربوط به تلگرام
Route::post('/telegram/login', [TelegramAuthController::class, 'login'])->name('telegram.login');

// بخش مربوط به اطلاعیه‌ها
Route::get('/notifications', [NotificationController::class, 'show'])->middleware('auth');
Route::get('/notifications/create', [NotificationController::class, 'create'])->middleware('auth');
Route::post('/notifications', [NotificationController::class, 'store'])->name('notifications.store');
Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');


// مسیرهای احراز هویت لاراول
require __DIR__.'/auth.php';

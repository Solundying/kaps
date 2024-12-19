<?php
// api.php
use App\Http\Controllers\PageController;
use App\Http\Controllers\TabController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\NotificationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// مدیریت صفحات (API)
Route::apiResource('pages', PageController::class);
Route::apiResource('pages.tabs', TabController::class)->shallow();

Route::middleware(['auth.api'])->group(function () {
    // مسیرهای عمومی
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/profile', [ProfileController::class, 'show']);
    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy']);


    // مدیریت کارها (Tasks)
    Route::apiResource('tasks', TaskController::class);

    // مدیریت اعلان‌ها (Notifications)
    Route::prefix('notifications')->group(function () {
        Route::get('/', [NotificationController::class, 'index']);
        Route::post('/', [NotificationController::class, 'store']);
        Route::patch('/{id}/mark-as-read', [NotificationController::class, 'markAsRead']);
        Route::delete('/notifications/{id}', [NotificationController::class, 'destroy']);

    });
    
    
    
});

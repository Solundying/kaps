<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * نمایش داشبورد کاربر
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        // داده‌های نمونه برای داشبورد
        $data = [
            'welcome_message' => 'Welcome to your dashboard, ' . $request->user()->name,
            'tasks' => [
                ['title' => 'Task 1', 'status' => 'completed'],
                ['title' => 'Task 2', 'status' => 'in-progress'],
                ['title' => 'Task 3', 'status' => 'pending'],
            ],
        ];

        return response()->json($data);
    }
}

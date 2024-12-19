<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('tasks', function (Blueprint $table) {
        $table->id(); // کلید اصلی
        $table->string('title'); // عنوان وظیفه
        $table->enum('status', ['pending', 'in-progress', 'completed'])->default('pending'); // وضعیت
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // ارتباط با جدول کاربران
        $table->timestamps(); // تاریخ ایجاد و به‌روزرسانی
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};

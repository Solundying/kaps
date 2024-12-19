<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyUsersTableForTelegram extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // تغییر ستون‌های password و email به nullable
            $table->string('password')->nullable()->change();
            $table->string('email')->nullable()->change();

            // افزودن ستون جدید برای نام کاربری تلگرام
            $table->string('telegram_username')->nullable()->after('telegram_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // بازگشت تغییرات
            $table->string('password')->nullable(false)->change();
            $table->string('email')->nullable(false)->change();
            $table->dropColumn('telegram_username');
        });
    }
}

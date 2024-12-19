<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str; // ایمپورت کلاس Str
use App\Models\Role;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'telegram_id',
        'telegram_username',
        'role_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * ارتباط کاربر با نقش
     *
     * @return BelongsTo
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * ایجاد توکن API برای کاربر
     *
     * @return void
     */
    public function generateApiToken()
    {
        $this->api_token = Str::random(60); // ایجاد یک توکن تصادفی
        $this->save();
    }

    public function tasks()
{
    return $this->hasMany(Task::class);
}
public function notifications()
{
    return $this->morphMany(Notification::class, 'notifiable');
}
use Notifiable;

    public function notification()
    {
        return $this->hasMany(Notification::class);
    }

}

<?php
// app/Models/Page.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'content', 'is_active'];

    // تعریف رابطه با تب‌ها
    public function tabs()
    {
        return $this->hasMany(Tab::class);
    }
}

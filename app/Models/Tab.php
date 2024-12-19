<?php
// app/Models/Tab.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tab extends Model
{
    protected $fillable = ['page_id', 'name', 'order', 'is_active'];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}

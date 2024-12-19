<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsSeeder extends Seeder
{
    public function run()
    {
        Setting::updateOrCreate(['key' => 'site_name'], ['value' => 'Default Site Name']);
        Setting::updateOrCreate(['key' => 'email'], ['value' => 'admin@example.com']);
        Setting::updateOrCreate(['key' => 'timezone'], ['value' => 'UTC']);
    }
}

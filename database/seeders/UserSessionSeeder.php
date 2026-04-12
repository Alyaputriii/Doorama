<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserSession;

class UserSessionSeeder extends Seeder
{
    public function run(): void
    {
        UserSession::create([
            'user_id' => 1,
            'login_time' => now()->subHours(1),
            'logout_time' => null,
            'session_status' => 'active',
            'ip_address' => '127.0.0.1',
            'user_agent' => 'Chrome on Windows',
            'created_at' => now()->subHours(1),
            'updated_at' => now()->subHours(1),
        ]);
    }
}
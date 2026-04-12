<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AccessLog;

class AccessLogSeeder extends Seeder
{
    public function run(): void
    {
        AccessLog::create([
            'user_id' => 1,
            'session_id' => 1,
            'event_type' => 'door_access',
            'description' => 'Door Unlocked',
            'result' => 'success',
            'knock_count' => 3,
            'ml_score' => 95.50,
            'door_state' => 'unlocked',
            'lock_state' => 'open',
            'system_mode' => 'normal',
            'created_at' => now()->subMinutes(5),
        ]);

        AccessLog::create([
            'user_id' => 1,
            'session_id' => 1,
            'event_type' => 'knock_attempt',
            'description' => 'Wrong Knock',
            'result' => 'failed',
            'knock_count' => 2,
            'ml_score' => 40.25,
            'door_state' => 'locked',
            'lock_state' => 'closed',
            'system_mode' => 'normal',
        ]);

        AccessLog::create([
            'user_id' => 1,
            'session_id' => 1,
            'event_type' => 'door_access',
            'description' => 'Door Locked',
            'result' => 'success',
            'knock_count' => 0,
            'ml_score' => 0,
            'door_state' => 'locked',
            'lock_state' => 'closed',
            'system_mode' => 'normal',
        ]);
    }
}
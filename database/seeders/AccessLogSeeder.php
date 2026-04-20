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
            'event_type' => 'Door Unlocked (Knock Pattern)',
            'description' => 'Valid knock pattern detected',
            'result' => 'success',
            'knock_count' => 3,
            'ml_score' => 95.50,
            'door_state' => 'closed',
            'lock_state' => 'unlocked',
            'system_mode' => 'normal',
            'created_at' => now()->subMinutes(5),
        ]);

        AccessLog::create([
            'user_id' => 1,
            'session_id' => 1,
            'event_type' => 'Door Opened',
            'description' => 'Door opened after authentication',
            'result' => 'success',
            'knock_count' => 0,
            'ml_score' => null,
            'door_state' => 'opened',
            'lock_state' => 'unlocked',
            'system_mode' => 'normal',
            'created_at' => now()->subMinutes(4),
        ]);

        AccessLog::create([
            'user_id' => 1,
            'session_id' => 1,
            'event_type' => 'Wrong Knock Pattern',
            'description' => 'Knock pattern mismatch',
            'result' => 'failed',
            'knock_count' => 2,
            'ml_score' => 40.25,
            'door_state' => 'closed',
            'lock_state' => 'locked',
            'system_mode' => 'normal',
            'created_at' => now()->subMinutes(3),
        ]);

        AccessLog::create([
            'user_id' => 1,
            'session_id' => 1,
            'event_type' => 'Door Locked',
            'description' => 'Door locked by system',
            'result' => 'success',
            'knock_count' => 0,
            'ml_score' => null,
            'door_state' => 'closed',
            'lock_state' => 'locked',
            'system_mode' => 'normal',
            'created_at' => now()->subMinutes(2),
        ]);

        AccessLog::create([
            'user_id' => 1,
            'session_id' => 1,
            'event_type' => 'Unauthorized Attempt',
            'description' => 'Multiple failed attempts detected',
            'result' => 'failed',
            'knock_count' => 3,
            'ml_score' => 20.10,
            'door_state' => 'closed',
            'lock_state' => 'locked',
            'system_mode' => 'normal',
            'created_at' => now()->subMinute(),
        ]);
    }
}
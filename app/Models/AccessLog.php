<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccessLog extends Model
{
    protected $table = 'access_logs';
    protected $primaryKey = 'log_id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'session_id',
        'event_type',
        'description',
        'result',
        'knock_count',
        'ml_score',
        'door_state',
        'lock_state',
        'system_mode',
        'created_at',
    ];
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSession extends Model
{
    protected $table = 'user_sessions';
    protected $primaryKey = 'session_id';
    public $incrementing = true;
    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'login_time',
        'logout_time',
        'session_status',
        'ip_address',
        'user_agent',
        'created_at',
        'updated_at',
    ];
}
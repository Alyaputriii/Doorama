<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemConfig extends Model
{
    protected $table = 'system_configs';
    protected $primaryKey = 'config_id';
    public $timestamps = false;

    protected $fillable = [
        'updated_by',
        'failed_attempt_limit',
        'debounce_time',
        'config_mode_timeout',
        'softap_ssid',
        'knock_timeout',
        'lockout_duration',
        'created_at',
        'updated_at',
    ];
}
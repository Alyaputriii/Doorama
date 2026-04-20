<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConfigChangeLog extends Model
{
    protected $table = 'config_change_logs';
    protected $primaryKey = 'change_id';
    public $timestamps = false;

    protected $fillable = [
        'config_id',
        'user_id',
        'session_id',
        'field_name',
        'old_value',
        'new_value',
        'changed_at',
    ];
}
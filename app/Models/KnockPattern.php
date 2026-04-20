<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KnockPattern extends Model
{
    protected $table = 'knock_patterns';
    protected $primaryKey = 'pattern_id';

    protected $fillable = [
        'user_id',
        'pattern_name',
        'feature_data',
        'threshold',
        'is_active',
    ];

    protected $casts = [
        'feature_data' => 'array',
        'is_active' => 'boolean',
        'threshold' => 'decimal:2',
    ];
}
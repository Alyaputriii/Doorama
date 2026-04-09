<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KnockPattern extends Model
{
    protected $fillable = [
        'user_id',
        'pattern_data',
    ];

    protected function casts(): array
    {
        return [
            'pattern_data' => 'encrypted',
        ];
    }
}
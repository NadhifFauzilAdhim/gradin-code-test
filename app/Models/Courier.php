<?php

namespace App\Models;

use Database\Factories\CourierFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courier extends Model
{
    /** @use HasFactory<CourierFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'email',
        'phone',
        'service_area',
        'level',
        'is_active',
        'registered_at',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'level' => 'integer',
            'registered_at' => 'datetime',
        ];
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_active',
        'name',
        'type',
        'data',
    ];

    protected $casts = [
        'data' => 'array',
    ];
}

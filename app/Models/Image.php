<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $casts = [
        'urls' => 'array',
    ];

    protected $fillable = [
        'urls',
        'product_id',
    ];
}

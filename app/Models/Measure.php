<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Measure extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_active',
        'size',
        'quantity',
        'unit',
        'type',
    ];

    public function getNameAttribute(): string
    {
        $presentationName = '';
        if ($this->size !== '') {
            return $this->size;
        }
        if ($this->quantity != 1) {
            $presentationName = "{$this->unit}s";
        }
        return "{$this->quantity} {$presentationName}";
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}

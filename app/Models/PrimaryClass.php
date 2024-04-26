<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PrimaryClass extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_active',
        'name',
        'description',
    ];

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class);
    }

    public function brands(): BelongsToMany
    {
        return $this->belongsToMany(Brand::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        // 'primary_class_id',
        'is_active',
        'name',
    ];

    public function primaryClasses(): BelongsToMany
    {
        return $this->belongsToMany(PrimaryClass::class);
    }

    public function genders(): BelongsToMany
    {
        return $this->belongsToMany(Gender::class);
    }

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    // public function products(): HasMany
    // {
    //     return $this->hasMany(Product::class);
    // }
}

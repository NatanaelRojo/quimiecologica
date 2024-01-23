<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        // 'category_id',
        // 'gender_id',
        'published',
        'title',
        'slug',
        'thumbnail',
        'body',
    ];

    protected $casts = [
        'published' => 'boolean',
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function genders(): BelongsToMany
    {
        return $this->belongsToMany(Gender::class);
    }
}

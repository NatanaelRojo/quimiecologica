<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Gender extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class);
        (Product::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}

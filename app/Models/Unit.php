<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Unit extends Model
{
    use HasFactory;

    protected  $fillable = [
        'name',
        'abbreviation',
    ];

    /**
     * The function `products` establishes a one-to-many relationship between the current model and the
     * `Product` model in PHP using Laravel's Eloquent ORM.
     * 
     * @return HasMany The `products` method is returning a HasMany relationship between the current
     * model and the `Product` model. This indicates a one-to-many relationship where a single instance
     * of the current model can have multiple instances of the `Product` model.
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}

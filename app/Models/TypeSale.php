<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TypeSale extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_active',
        'name',
        'description',
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

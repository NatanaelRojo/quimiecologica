<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

class PrimaryClass extends Model
{
    use HasFactory;
    use Sluggable, SluggableScopeHelpers;

    protected $fillable = [
        'is_active',
        'logo_url',
        'name',
        'description',
    ];

    /**
     * The sluggable function in PHP returns an array with a key 'slug' and its corresponding value as an
     * array with a key 'source' set to 'name'.
     * 
     * @return array An array with a key 'slug' and a value of an array with a key 'source' set to 'name'
     * is being returned.
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ],
        ];
    }

    /**
     * The getRouteKeyName function in PHP returns the string 'slug'.
     * 
     * @return string The method `getRouteKeyName()` is returning the string 'slug'.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * The function `categories()` establishes a many-to-many relationship between the current model and
     * the `Category` model in PHP using Laravel's Eloquent ORM.
     * 
     * @return BelongsToMany The `categories()` method is returning a BelongsToMany relationship. This
     * method defines a many-to-many relationship between the current model and the `Category` model.
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * The brands function returns a BelongsToMany relationship with the Brand model in PHP.
     * 
     * @return BelongsToMany The `brands()` method is returning a BelongsToMany relationship between the
     * current model and the `Brand` model. This indicates a many-to-many relationship where the current
     * model can be associated with multiple `Brand` models and vice versa.
     */
    public function brands(): BelongsToMany
    {
        return $this->belongsToMany(Brand::class);
    }

    /**
     * The products function returns a collection of products associated with the current model.
     * 
     * @return HasMany A relationship method named `products` is being returned, which defines a
     * one-to-many relationship between the current model and the `Product` model. This method returns a
     * `HasMany` relationship instance.
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    /**
     * The scopeAllActive function filters query results to only include records that are marked as active.
     * 
     * @param Builder query The `` parameter in the `scopeAllActive` function is an instance of the
     * `Illuminate\Database\Eloquent\Builder` class. This parameter represents the query builder instance
     * for the model on which the scope is being applied.
     */
    public function scopeAllActive(Builder $query): void
    {
        $query->where('is_active', true);
    }
}

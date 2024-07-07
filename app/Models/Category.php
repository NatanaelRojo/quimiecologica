<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    use Sluggable, SluggableScopeHelpers;

    protected $fillable = [
        'is_active',
        'logo_url',
        'name',
    ];

    /**
     * The sluggable function in PHP returns an array with a key 'slug' and a value 'name' as the source.
     * 
     * @return array An array with a key 'slug' and its value being an array with a key 'source' set to
     * 'name' is being returned.
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }

    /**
     * The getRouteKeyName function in PHP returns the key name 'slug'.
     * 
     * @return string The method `getRouteKeyName()` is returning the string 'slug'. This method is
     * typically used in Laravel Eloquent models to specify the attribute that should be used when
     * retrieving a model by its route key. In this case, the 'slug' attribute will be used as the route
     * key for the model.
     */
    /* The `getRouteKeyName()` function in the provided PHP code is defining a method within the
    `Category` model class. This method is used in Laravel Eloquent models to specify the attribute
    that should be used when retrieving a model by its route key. */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * The function `brands()` establishes a many-to-many relationship between the current model and the
     * `Brand` model in PHP using Laravel's Eloquent ORM.
     * 
     * @return BelongsToMany The `brands()` method is returning a BelongsToMany relationship. This method
     * defines a many-to-many relationship between the current model and the `Brand` model.
     */
    public function brands(): BelongsToMany
    {
        return $this->belongsToMany(Brand::class);
    }

    /**
     * The function `primaryClasses()` defines a many-to-many relationship in PHP using Laravel's Eloquent
     * ORM.
     * 
     * @return BelongsToMany A BelongsToMany relationship is being returned. This method defines a
     * many-to-many relationship between the current model and the PrimaryClass model.
     */
    public function primaryClasses(): BelongsToMany
    {
        return $this->belongsToMany(PrimaryClass::class);
    }

    /**
     * The function `genders()` establishes a many-to-many relationship between the current model and the
     * `Gender` model in PHP using Laravel's Eloquent ORM.
     * 
     * @return BelongsToMany A BelongsToMany relationship is being returned. This method defines a
     * many-to-many relationship between the current model and the Gender model.
     */
    public function genders(): BelongsToMany
    {
        return $this->belongsToMany(Gender::class);
    }

    /**
     * The `posts` function defines a many-to-many relationship between the current model and the `Post`
     * model in PHP using Laravel's Eloquent ORM.
     * 
     * @return BelongsToMany A BelongsToMany relationship is being returned. This method defines a
     * many-to-many relationship between the current model and the Post model.
     */
    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class);
    }

    /**
     * The products function defines a many-to-many relationship between the current model and the Product
     * model in PHP using Laravel's Eloquent ORM.
     * 
     * @return BelongsToMany A BelongsToMany relationship is being returned.
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}

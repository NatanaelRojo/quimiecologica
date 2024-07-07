<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Gender extends Model
{
    use HasFactory;
    use Sluggable, SluggableScopeHelpers;

    protected $fillable = [
        'is_active',
        'logo_url',
        'name',
    ];

    /**
     * The sluggable function in PHP returns an array with a key 'slug' and a value 'name'.
     * 
     * @return array An array with a key 'slug' and a value of an array with a key 'source' set to 'name'
     * is being returned.
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
     * The getRouteKeyName function in PHP returns the string 'slug'.
     * 
     * @return string The method `getRouteKeyName()` is returning the string 'slug'.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * The function `brands` establishes a many-to-many relationship between the current model and the
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
     * The function `primaryClasses` establishes a many-to-many relationship between the current model
     * and the `PrimaryClass` model in PHP using Laravel's Eloquent ORM.
     * 
     * @return BelongsToMany The `primaryClasses()` method is returning a BelongsToMany relationship.
     * This method defines a many-to-many relationship between the current model and the
     * `PrimaryClass` model.
     */
    public function primaryClasses(): BelongsToMany
    {
        return $this->belongsToMany(PrimaryClass::class);
    }

    /**
     * The function `categories` establishes a many-to-many relationship between the current model and the
     * `Category` model in PHP using Laravel's Eloquent ORM.
     * 
     * @return BelongsToMany The `categories()` method is returning a BelongsToMany relationship. This
     * method defines a many-to-many relationship between the current model and the `Category` model.
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
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
     * The products function establishes a many-to-many relationship between the current model and the
     * Product model in PHP.
     * 
     * @return BelongsToMany A BelongsToMany relationship is being returned. This method defines a
     * many-to-many relationship between the current model and the Product model.
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}

<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Builder;

class Brand extends Model
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
     * Return the sluggable configuration array for this model.
     *
     * @return array
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
     * @return string The method `getRouteKeyName()` is returning the string 'slug'.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * The `primaryClasses` function defines a many-to-many relationship in PHP using Laravel's Eloquent
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
     * The `categories` function defines a many-to-many relationship in PHP using Laravel's Eloquent
     * ORM.
     * 
     * @return BelongsToMany A BelongsToMany relationship is being returned. This method defines a
     * many-to-many relationship between the current model and the Category model.
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * The `genders` function defines a many-to-many relationship in PHP using Laravel's Eloquent ORM.
     * 
     * @return BelongsToMany A BelongsToMany relationship is being returned. This method defines a
     * many-to-many relationship between the current model and the Gender model.
     */
    public function genders(): BelongsToMany
    {
        return $this->belongsToMany(Gender::class);
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

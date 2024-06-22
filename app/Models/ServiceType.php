<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ServiceType extends Model
{
    use HasFactory;
    use Sluggable, SluggableScopeHelpers;

    protected $fillable = [
        'is_active',
        'logo_url',
        'name',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

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
     * @return string The method `getRouteKeyName` is returning the string 'slug'.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * The function `services` establishes a one-to-many relationship between the current model and the
     * `Service` model in PHP using Laravel's Eloquent ORM.
     * 
     * @return HasMany The `services` method is returning a HasMany relationship between the current
     * model and the `Service` model. This indicates a one-to-many relationship where a single instance
     * of the current model can have multiple instances of the `Service` model.
     */
    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }

    /**
     * The scopeAllActive function filters records based on the 'is_active' column being true.
     * 
     * @param Builder query The `query` parameter in the `scopeAllActive` function is an instance of the
     * `Illuminate\Database\Eloquent\Builder` class. This parameter represents the query builder instance
     * for the model on which the scope is being applied.
     * 
     * @return void
     */
    public function scopeAllActive(Builder $query): void
    {
        $query->where('is_active', true);
    }
}

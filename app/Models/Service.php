<?php

namespace App\Models;

use App\Casts\MoneyCast;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Service extends Model
{
    use HasFactory;
    use Sluggable, SluggableScopeHelpers;

    protected $fillable = [
        'is_active',
        'service_type_id',
        'banner',
        'name',
        'description',
        'price',
        'conditions',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'price' => MoneyCast::class,
        'conditions' => 'array',
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
     * The function `serviceType` defines a relationship where the current model belongs to a ServiceType model.
     * 
     * @return BelongsTo A BelongsTo relationship is being returned. This indicates that the current model
     * belongs to a ServiceType model.
     */
    public function serviceType(): BelongsTo
    {
        return $this->belongsTo(ServiceType::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function purchaseOrders(): HasMany
    {
        return $this->hasMany(PurchaseOrder::class);
    }

    /**
     * The function `allActive` returns all active services in the database using a scope called `allActive`.
     * 
     * @param  Builder  $query The query builder object.
     * @return void
     */
    public function scopeAllActive(Builder $query): void
    {
        $query->where('is_active', true);
    }
}

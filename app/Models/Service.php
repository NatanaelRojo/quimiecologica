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

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

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

    // public function conditions(): MorphMany
    // {
    //     return $this->morphMany(Condition::class, 'conditionable');
    // }

    public function scopeAllActive(Builder $query): void
    {
        $query->where('is_active', true);
    }
}

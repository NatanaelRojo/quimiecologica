<?php

namespace App\Models;

use App\Casts\MoneyCast;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;
    use Sluggable, SluggableScopeHelpers;

    protected $casts = [
        'price' => MoneyCast::class,
        'image_urls' => 'json',
        'is_active' => 'boolean',
    ];

    protected $fillable = [
        'name',
        // 'slug',
        'description',
        'stock',
        'price',
        'image_urls',
        // 'service_id',
        // 'gender_id',
        // 'category_id',
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

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function pendingOrders(): HasMany
    {
        return $this->hasMany(PendingOrder::class);
    }

    // public function service(): BelongsTo
    // {
    //     return $this->belongsTo(Service::class);
    // }

    public function genders(): BelongsToMany
    {
        return $this->belongsToMany(Gender::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function purchaseWholesaleOrders(): HasMany
    {
        return $this->hasMany(PurchaseWholesaleOrder::class);
    }

    public function purchaseRetailOrders(): BelongsToMany
    {
        return $this->belongsToMany(PurchaseRetailOrder::class, 'product_purchase_order');
    }

    public function typeSales(): BelongsToMany
    {
        return $this->belongsToMany(TypeSale::class);
    }

    public function scopeFilterByName(Builder $query, string $searchTerm): void
    {
        $query->where('name', 'ilike', "%{$searchTerm}%");
    }

    public function scopeFilterByCategoryOrGender(Builder $query, ?string $categoriesString, ?string $gendersString): void
    {
        $categories = $categoriesString ? explode(',', $categoriesString) : [];
        $genders = $gendersString ? explode(',', $gendersString) : [];
        $query->where(function (Builder $query) use ($categories, $genders): void {
            foreach (['categories', 'genders'] as $type) {
                if (!empty($$type)) {
                    $values = $$type;
                    $query->orWhereHas($type, function (Builder $q) use ($values): void {
                        $q->whereIn('name', $values);
                    });
                }
            }
        });
    }

    public function scopeFilterByPrice(Builder $query, ?string $stringPrice, ?string $operator): void
    {
        $productPrice = floatval($stringPrice);
        $query->where('price', $operator, $productPrice * 100);
    }
}

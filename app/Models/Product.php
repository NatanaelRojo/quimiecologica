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
        'wholesale_price' => MoneyCast::class,
        'image_urls' => 'json',
        'is_active' => 'boolean',
    ];

    protected $fillable = [
        'primary_class_id',
        // 'brand_id',
        'type_sale_id',
        'unit_id',
        'is_active',
        'name',
        'description',
        'stock',
        'quantity',
        'price',
        'wholesale_price',
        'image_urls',
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

    public function primaryClass(): BelongsTo
    {
        return $this->belongsTo(PrimaryClass::class);
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

    public function measures(): BelongsToMany
    {
        return $this->belongsToMany(Measure::class);
    }

    public function purchaseWholesaleOrders(): HasMany
    {
        return $this->hasMany(PurchaseWholesaleOrder::class);
    }

    public function purchaseRetailOrders(): BelongsToMany
    {
        return $this->belongsToMany(PurchaseRetailOrder::class, 'product_purchase_order');
    }

    public function typeSale(): BelongsTo
    {
        return $this->belongsTo(TypeSale::class);
    }

    public function scopeAllActive(Builder $query): void
    {
        $query->where('is_active', true);
    }

    public function scopeFilterByName(Builder $query, ?string $searchTerm): void
    {
        $query->where('name', 'ilike', "%{$searchTerm}%");
    }

    public function scopeFilterBySaleType(?Builder $query, string $saleTypeName): void
    {
        $query->where(function (Builder $query) use ($saleTypeName): void {
            $query->whereHas('typeSale', function (Builder $q) use ($saleTypeName): void {
                $q->where('name', $saleTypeName);
            });
        });
        // $query->where(function (Builder $query) use ($saleTypeName): void {
        //     $query->whereHas('typeSales', function (Builder $q) use ($saleTypeName): void {
        //         $q->whereIn('name', [$saleTypeName]);
        //     });
        // });
    }

    public function scopeFilterByCategoryOrGender(Builder $query, ?string $categoriesString, ?string $gendersString): void
    {
        // $categories = $categoriesString ? explode(',', $categoriesString) : [];
        // $genders = $gendersString ? explode(',', $gendersString) : [];
        $categories = $categoriesString ? [$categoriesString] : [];
        $genders = $gendersString ? [$gendersString] : [];
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

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    public function productTypes(): BelongsToMany
    {
        return $this->belongsToMany(ProductType::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }
}

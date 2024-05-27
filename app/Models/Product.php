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
        'brand_id',
        'primary_class_id',
        'category_id',
        'gender_id',
        'type_sale_id',
        // 'unit_id',
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

    public function brands(): BelongsToMany
    {
        return $this->belongsToMany(Brand::class);
    }

    public function gender(): BelongsTo
    {
        return $this->belongsTo(Gender::class);
    }

    public function genders(): BelongsToMany
    {
        return $this->belongsToMany(Gender::class,);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
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

    public function scopeAllActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeFilterByName(Builder $query, ?string $searchTerm): Builder
    {
        return $query->where('name', 'ilike', "%{$searchTerm}%");
    }

    public function scopeFilterBySaleType(?Builder $query, ?string $saleTypeName): Builder
    {
        return             $query->whereHas('typeSale', function (Builder $q) use ($saleTypeName): Builder {
            return $q->where('name', $saleTypeName);
        });
    }

    public function scopeFilterByBrand(Builder $query, ?string $brand): Builder
    {
        return $query->whereHas('brand', function (Builder $q) use ($brand): Builder {
            return $q->where('name', $brand);
        });
    }

    public function scopeFilterByPrimaryClass(Builder $query, ?string $primaryClass): Builder
    {
        return $query->whereHas('primaryClass', function (Builder $q) use ($primaryClass): Builder {
            return $q->where('name', $primaryClass);
        });
    }

    public function scopeFilterByCategory(Builder $query, ?string $categories): Builder
    {
        $categories = $categories ? [$categories] : [];
        return $query->whereHas('categories', function (Builder $q) use ($categories): Builder {
            return $q->whereIn('name', $categories);
        });
    }

    public function scopeFilterByGenders(Builder $query, ?string $genders): Builder
    {
        $genders = $genders ? [$genders] : [];
        return $query->whereHas('genders', function (Builder $q) use ($genders): Builder {
            return $q->whereIn('name', $genders);
        });
    }

    public function scopeFilterByCategoryOrGender(Builder $query, ?string $categoriesString, ?string $gendersString): Builder
    {
        // $categories = $categoriesString ? explode(',', $categoriesString) : [];
        // $genders = $gendersString ? explode(',', $gendersString) : [];
        $categories = $categoriesString ? [$categoriesString] : [];
        $genders = $gendersString ? [$gendersString] : [];
        return $query->where(function (Builder $query) use ($categories, $genders): void {
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

    public function scopeApplyParameters(Builder $query, ?array $filterParameters): void
    {
        $query->filterByBrand($filterParameters['brand'])
            ->filterByPrimaryClass($filterParameters['primary_class'])
            ->filterByCategory($filterParameters['category'])
            ->filterByGenders($filterParameters['gender'])
            // ->filterByCategoryOrGender($filterParameters['category'], $filterParameters['gender'])
            ->allActive();
    }

    public function scopeFilterByPrice(Builder $query, ?string $stringPrice, ?string $operator): Builder
    {
        $productPrice = floatval($stringPrice);
        return $query->where('price', $operator, $productPrice * 100);
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

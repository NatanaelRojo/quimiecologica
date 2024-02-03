<?php

namespace App\Models;

use App\Casts\MoneyCast;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $casts = [
        'price' => MoneyCast::class,
        'image_urls' => 'json',
    ];

    protected $fillable = [
        'name',
        'description',
        'stock',
        'price',
        'image_urls',
        // 'service_id',
        // 'gender_id',
        // 'category_id',
    ];

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

    public function scopeFilterBy(Builder $query, array $categories, array $genders): void
    {
        $query->when(!empty($categories), function (Builder $query) use ($categories): void {
            $query->whereHas('categories', fn (Builder $q) => $q->whereIn('name', $categories));
        })->when(!empty($genders), function (Builder $query) use ($genders): void {
            $query->whereHas('genders', fn (Builder $q) => $q->whereIn('name', $genders));
        });
    }
}

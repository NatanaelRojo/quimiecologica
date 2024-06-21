<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PaymentType extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_active',
        'name',
    ];

    /**
     * The `paymentMethods` function returns a collection of PaymentMethod models associated with the
     * current model.
     * 
     * @return HasMany A relationship method named `paymentMethods` is being returned, which defines a
     * one-to-many relationship between the current model and the `PaymentMethod` model.
     */
    public function paymentMethods(): HasMany
    {
        return $this->hasMany(PaymentMethod::class);
    }

    /**
     * The scopeAllActive function filters records based on the 'is_active' column being true.
     * 
     * @param Builder query The `query` parameter in the `scopeAllActive` function is an instance of the
     * `Illuminate\Database\Eloquent\Builder` class. This parameter represents the query builder instance
     * for the model on which the scope is being applied.
     * 
     * @return Builder The `scopeAllActive` function is returning a query builder instance with a condition
     * applied to filter records where the `is_active` column is true.
     */
    public function scopeAllActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }
}

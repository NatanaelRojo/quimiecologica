<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_type_id',
        'is_active',
        'name',
        'type',
        'data',
    ];

    /* The `protected ` property in the `PaymentMethod` model is used to define how attributes should
be cast to native PHP types. In this case, the `'data' => 'array'` configuration specifies that the
`data` attribute of the `PaymentMethod` model should be cast to an array when retrieved from the
database or serialized to JSON. */
    protected $casts = [
        'data' => 'array',
    ];

    /**
     * The function `paymentType` returns a BelongsTo relationship with the `PaymentType` model in PHP.
     * 
     * @return BelongsTo A BelongsTo relationship is being returned. This indicates that the current model
     * belongs to a PaymentType model.
     */
    public function paymentType(): BelongsTo
    {
        return $this->belongsTo(PaymentType::class);
    }

    /**
     * The `scopeAllActive` function filters records to only include those that are active.
     * 
     * @param Builder query The `query` parameter is an instance of the
     * `Illuminate\Database\Eloquent\Builder` class, which represents a query builder for a specific model
     * in Laravel. It allows you to construct queries for retrieving and manipulating data from the
     * corresponding database table. In this context, the `scopeAllActive` function is a
     * 
     * @return Builder The `scopeAllActive` function is returning a query builder instance with a condition
     * applied to filter records where the `is_active` column is true.
     */
    public function scopeAllActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }
}

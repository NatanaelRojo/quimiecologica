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

    protected $casts = [
        'data' => 'array',
    ];

    public function paymentType(): BelongsTo
    {
        return $this->belongsTo(PaymentType::class);
    }

    public function scopeAllActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }
}

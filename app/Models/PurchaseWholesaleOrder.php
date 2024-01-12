<?php

namespace App\Models;

use App\Casts\MoneyCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PurchaseWholesaleOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'owner_firstname',
        'owner_lastname',
        'owner_id',
        'owner_phone_number',
        'owner_state',
        'owner_city',
        'owner_address',
        'reference_number',
        'image',
        'total_price',
        'product_quantity',
        'unit',
    ];

    protected $casts = [
        'total_price' => MoneyCast::class,
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}

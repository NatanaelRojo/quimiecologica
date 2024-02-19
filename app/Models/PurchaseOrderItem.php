<?php

namespace App\Models;

use App\Casts\MoneyCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PurchaseOrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'purchase_type',
        'product_quantity',
        'product_price',
        'product_unit',
    ];

    protected $casts  = [
        'product_price' => MoneyCast::class,
    ];

    public function purchaseOrder(): BelongsToMany
    {
        return $this->belongsToMany(PurchaseOrder::class);
    }
}

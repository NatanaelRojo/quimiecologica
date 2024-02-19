<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PurchaseOrder extends Model
{
    use HasFactory;

    protected $fillable = [
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
        'product_info',
        'status',
    ];

    protected $casts = [
        'product_info' => 'array',
    ];

    public function purchaseOrderItems(): BelongsToMany
    {
        return $this->belongsToMany(PurchaseOrderItem::class);
    }
}

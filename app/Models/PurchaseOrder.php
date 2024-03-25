<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class PurchaseOrder extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';


    protected $fillable = [
        'owner_firstname',
        'owner_lastname',
        'owner_id',
        'owner_email',
        'owner_phone_number',
        'owner_state',
        'owner_city',
        'owner_address',
        'reference_number',
        'image',
        'total_price',
        'products_info',
        'status',
    ];

    protected $casts = [
        'products_info' => 'array',
    ];

    protected static function booted(): void
    {
        static::creating(function (PurchaseOrder $model): void {
            $model->id = Str::uuid();
        });
    }

    // public function getRouteKeyName(): string
    // {
    //     return 'uuid';
    // }

    public function purchaseOrderItems(): BelongsToMany
    {
        return $this->belongsToMany(PurchaseOrderItem::class);
    }
}

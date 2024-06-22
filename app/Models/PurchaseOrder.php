<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
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

    /**
     * The `booted` method of the model will be called shortly after the model is instantiated and
     * made visible to the application.
     * 
     * @return void
     */
    protected static function booted(): void
    {
        static::creating(function (PurchaseOrder $model): void {
            $model->id = Str::uuid();
        });
    }
}

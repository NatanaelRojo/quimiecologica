<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class PendingOrder extends Model
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
        'owner_request',
        'deadline',
    ];

    /**
     * The `booted` method of the model will be called shortly after the model is instantiated and
     * made visible to the application.
     * 
     * @return void
     */
    protected static function booted(): void
    {
        static::creating(function (PendingOrder $model): void {
            $model->id = Str::uuid();
        });
    }

    /**
     * The function `service` defines a relationship where the current model belongs to a Service model.
     * 
     * @return BelongsTo A BelongsTo relationship is being returned. This indicates that the current model
     * belongs to a Service model.
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * The function `gender` defines a relationship where the current model belongs to a Gender model.
     * 
     * @return BelongsTo A BelongsTo relationship is being returned. This indicates that the current model
     * belongs to a Gender model.
     */
    public function gender(): BelongsTo
    {
        return $this->belongsTo(Gender::class);
    }

    /**
     * The function `category` defines a relationship where the current model belongs to a Category model.
     * 
     * @return BelongsTo A BelongsTo relationship is being returned. This indicates that the current model
     * belongs to a Category model.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * The function `product` defines a relationship where the current model belongs to a Product model.
     * 
     * @return BelongsTo A BelongsTo relationship is being returned. This indicates that the current model
     * belongs to a Product model.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}

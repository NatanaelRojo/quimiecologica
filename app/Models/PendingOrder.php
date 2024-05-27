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
        // 'service_id',
        // 'gender_id',
        // 'category_id',
        // 'product_id',
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

    protected static function booted(): void
    {
        static::creating(function (PendingOrder $model): void {
            $model->id = Str::uuid();
        });
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function gender(): BelongsTo
    {
        return $this->belongsTo(Gender::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}

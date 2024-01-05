<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PurchaseOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'gender_id',
        'category_id',
        'owner_firstname',
        'owner_lastname',
        'owner_phone_number',
        'owner_state',
        'owner_city',
        'reference_number',
        'image',
        'total_price',
    ];

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
        return $this->belongsTo(Category::class, "category_id");
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_purchase_order');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class WholesalePackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity',
        // 'unit_id',
        'unit',
        'name',
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_wholesale_package', 'wholesale_package_id', 'product_id');
    }
}

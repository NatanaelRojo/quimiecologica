<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'logo_url',
        'name',
        'description',
    ];

    public function productTypes(): BelongsToMany
    {
        return $this->belongsToMany(ProductType::class);
    }
}

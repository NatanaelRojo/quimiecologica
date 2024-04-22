<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ProductType extends Model
{
    use HasFactory;

    protected $fillable = [
        'logo_url',
        'name',
        'description',
    ];

    public function brands(): BelongsToMany
    {
        return $this->belongsToMany(Brand::class);
    }
}

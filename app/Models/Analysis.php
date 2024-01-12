<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Analysis extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function types(): HasMany
    {
        return $this->hasMany(AnalysisType::class);
    }

    public function parameters(): HasMany
    {
        return $this->hasMany(AnalysisParameter::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AnalysisType extends Model
{
    use HasFactory;

    protected $fillable = [
        'analysis_id',
        'name',
        'description',
    ];

    public function analysis(): BelongsTo
    {
        return $this->belongsTo(Analysis::class);
    }

    public function analysisParameters(): HasMany
    {
        return $this->hasMany(AnalysisParameter::class);
    }
}

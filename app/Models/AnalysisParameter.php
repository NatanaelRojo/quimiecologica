<?php

namespace App\Models;

use App\Casts\MoneyCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AnalysisParameter extends Model
{
    use HasFactory;

    protected $fillable = [
        'analysis_id',
        'analysis_type_id',
        'name',
        'description',
        'price_per_hour',
    ];

    protected $casts = [
        'price_per_hour' => MoneyCast::class,
    ];

    public function analysis(): BelongsTo
    {
        return $this->belongsTo(Analysis::class);
    }

    public function analysisType(): BelongsTo
    {
        return $this->belongsTo(AnalysisType::class);
    }
}

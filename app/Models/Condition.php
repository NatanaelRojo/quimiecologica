<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Condition extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'conditionable_id',
        'conditionable_type',
    ];

    public function conditionable(): MorphTo
    {
        return $this->morphTo();
    }
}

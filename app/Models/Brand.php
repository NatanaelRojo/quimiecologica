<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Builder;

class Brand extends Model
{
    use HasFactory;
    use Sluggable, SluggableScopeHelpers;

    protected $fillable = [
        'is_active',
        'logo_url',
        'name',
        'description',
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function primaryClasses(): BelongsToMany
    {
        return $this->belongsToMany(PrimaryClass::class);
    }

    public function scopeAllActive(Builder $query): void
    {
        $query->where('is_active', true);
    }
}

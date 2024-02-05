<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Post extends Model
{
    use HasFactory;
    use Sluggable,  SluggableScopeHelpers;

    protected $fillable = [
        // 'category_id',
        // 'gender_id',
        'published',
        'title',
        // 'slug',
        'thumbnail',
        'body',
    ];

    protected $casts = [
        'published' => 'boolean',
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
                'source' => 'title',
            ],
        ];
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function genders(): BelongsToMany
    {
        return $this->belongsToMany(Gender::class);
    }

    public function scopeFilterBy(Builder $query, array $categories, array $genders): void
    {
        $query->when(!empty($categories), function (Builder $query) use ($categories): void {
            $query->whereHas('categories', fn (Builder $q) => $q->whereIn('name', $categories));
        })->when(!empty($genders), function (Builder $query) use ($genders): void {
            $query->whereHas('genders', fn (Builder $q) => $q->whereIn('name', $genders));
        });
    }
}

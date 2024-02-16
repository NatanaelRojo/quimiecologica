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

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function genders(): BelongsToMany
    {
        return $this->belongsToMany(Gender::class);
    }

    public function scopeAllPublished(Builder $query): void
    {
        $query->where('published',  true);
    }

    public function scopeFilterByTitle(Builder $query, ?string $searchTerm): void
    {
        $query->where('title', 'ilike', "%{$searchTerm}%");
    }

    public function scopeFilterByCategoryOrGender(Builder $query, ?string $categoriesString, ?string $gendersString): void
    {
        $categories = $categoriesString ? explode(',', $categoriesString) : [];
        $genders = $gendersString ? explode(',', $gendersString) : [];
        $query->where(function (Builder $query) use ($categories, $genders): void {
            foreach (['categories', 'genders'] as $type) {
                if (!empty($$type)) {
                    $values = $$type;
                    $query->orWhereHas($type, function (Builder $q) use ($values): void {
                        $q->whereIn('name', $values);
                    });
                }
            }
        });
    }
}

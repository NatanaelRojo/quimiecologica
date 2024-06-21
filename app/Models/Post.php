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
        'published',
        'title',
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

    /**
     * The getRouteKeyName function in PHP returns the string 'slug'.
     * 
     * @return string The method `getRouteKeyName()` is returning the string 'slug'.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * The function "categories" establishes a many-to-many relationship between the current model and the
     * "Category" model in PHP using Laravel's Eloquent ORM.
     * 
     * @return BelongsToMany The `categories()` method is returning a BelongsToMany relationship between
     * the current model and the `Category` model. This indicates a many-to-many relationship where the
     * current model can belong to multiple categories and a category can be associated with multiple
     * instances of the current model.
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * The `genders` function defines a many-to-many relationship between the current model and the
     * `Gender` model in PHP.
     * 
     * @return BelongsToMany A BelongsToMany relationship is being returned. This method defines a
     * many-to-many relationship between the current model and the Gender model.
     */
    public function genders(): BelongsToMany
    {
        return $this->belongsToMany(Gender::class);
    }

    /**
     * The scopeAllPublished function filters query results to include only those with 'published' set to
     * true.
     * 
     * @param Builder query The parameter `` in the `scopeAllPublished` function is an instance of
     * the `Illuminate\Database\Eloquent\Builder` class, which represents a query builder for Eloquent ORM
     * in Laravel. This parameter is used to build and modify database queries for retrieving data from the
     * database.
     */
    public function scopeAllPublished(Builder $query): void
    {
        $query->where('published',  true);
    }

    /**
     * The function filters query results by title using a case-insensitive search term in PHP.
     * 
     * @param Builder query The `` parameter is an instance of the Laravel query builder `Builder`
     * class. It represents the database query being built.
     * @param string The `` parameter is a string that represents the term you want to
     * search for in the `title` column of your database table. The `ilike` operator is used for
     * case-insensitive pattern matching in PostgreSQL databases. The `"%{}%"` syntax is used to
     */
    public function scopeFilterByTitle(Builder $query, ?string $searchTerm): void
    {
        $query->where('title', 'ilike', "%{$searchTerm}%");
    }

    /**
     * The function `scopeFilterByCategoryOrGender` filters a query based on category or gender values
     * provided as strings.
     * 
     * @param Builder query The `scopeFilterByCategoryOrGender` function is a query scope that filters the
     * query based on the provided category and gender values. It accepts the following parameters:
     * @param string The `scopeFilterByCategoryOrGender` function is used to filter a query based
     * on categories and genders. The function takes two parameters: `` and
     * ``, which are strings representing the categories and genders to filter by.
     * @param string The `gendersString` parameter in the `scopeFilterByCategoryOrGender` function
     * is used to filter the query results based on gender. If a gender string is provided, it will be used
     * to filter the results by gender. If the `gendersString` parameter is null or empty,
     */
    public function scopeFilterByCategoryOrGender(Builder $query, ?string $categoriesString, ?string $gendersString): void
    {
        $categories = $categoriesString ? [$categoriesString] : [];
        $genders = $gendersString ? [$gendersString] : [];

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

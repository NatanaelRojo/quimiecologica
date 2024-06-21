<?php

namespace App\Models;

use App\Casts\MoneyCast;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;
    use Sluggable, SluggableScopeHelpers;

    protected $casts = [
        'price' => MoneyCast::class,
        'wholesale_price' => MoneyCast::class,
        'image_urls' => 'json',
        'is_active' => 'boolean',
    ];

    protected $fillable = [
        'brand_id',
        'primary_class_id',
        'category_id',
        'gender_id',
        'type_sale_id',
        // 'unit_id',
        'is_active',
        'name',
        'description',
        'stock',
        'quantity',
        'price',
        'wholesale_price',
        'image_urls',
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

    /**
     * The getRouteKeyName function in PHP returns the key name 'slug'.
     * 
     * @return string The method `getRouteKeyName()` is returning the string 'slug'.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * The primaryClass function defines a one-to-one relationship between the current model and the
     * PrimaryClass model in PHP.
     * 
     * @return BelongsTo A BelongsTo relationship is being returned. This method defines a one-to-one
     * relationship between the current model and the PrimaryClass model.
     */
    public function primaryClass(): BelongsTo
    {
        return $this->belongsTo(PrimaryClass::class);
    }

    public function pendingOrders(): HasMany
    {
        return $this->hasMany(PendingOrder::class);
    }

    /**
     * The brands function defines a many-to-many relationship between the current model and the Brand
     * model in PHP.
     * 
     * @return BelongsToMany A BelongsToMany relationship is being returned. This method defines a
     * many-to-many relationship between the current model and the Brand model.
     */
    public function brands(): BelongsToMany
    {
        return $this->belongsToMany(Brand::class);
    }

    /**
     * The function "gender" returns a BelongsTo relationship with the Gender model in PHP.
     * 
     * @return BelongsTo A BelongsTo relationship is being returned.
     */
    public function gender(): BelongsTo
    {
        return $this->belongsTo(Gender::class);
    }

    /**
     * The function defines a many-to-many relationship between the current model and the Gender model in
     * PHP.
     * 
     * @return BelongsToMany A BelongsToMany relationship with the Gender model is being returned.
     */
    public function genders(): BelongsToMany
    {
        return $this->belongsToMany(Gender::class,);
    }

    /**
     * The function `category()` defines a relationship where the current model belongs to a Category model
     * in PHP using Laravel's Eloquent ORM.
     * 
     * @return BelongsTo A BelongsTo relationship is being returned. This indicates that the current model
     * belongs to a Category model.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * The function establishes a many-to-many relationship between the current model and the Category
     * model in PHP.
     * 
     * @return BelongsToMany A BelongsToMany relationship is being returned. This method defines a
     * many-to-many relationship between the current model and the Category model.
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * The `measures` function defines a many-to-many relationship between the current model and the
     * `Measure` model in PHP.
     * 
     * @return BelongsToMany A BelongsToMany relationship is being returned. This method defines a
     * many-to-many relationship between the current model and the Measure model.
     */
    public function measures(): BelongsToMany
    {
        return $this->belongsToMany(Measure::class);
    }

    public function purchaseWholesaleOrders(): HasMany
    {
        return $this->hasMany(PurchaseWholesaleOrder::class);
    }

    public function purchaseRetailOrders(): BelongsToMany
    {
        return $this->belongsToMany(PurchaseRetailOrder::class, 'product_purchase_order');
    }

    /**
     * The `typeSale` function in PHP returns a BelongsTo relationship with the TypeSale model.
     * 
     * @return BelongsTo A BelongsTo relationship is being returned.
     */
    public function typeSale(): BelongsTo
    {
        return $this->belongsTo(TypeSale::class);
    }

    /**
     * The `brand` function in PHP returns a BelongsTo relationship with the Brand model.
     * 
     * @return BelongsTo A BelongsTo relationship is being returned.
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }
    /**
     * The scopeAllActive function filters records to only include those that are active.
     * 
     * @param Builder query The `query` parameter is an instance of the
     * `Illuminate\Database\Eloquent\Builder` class, which represents a query builder for a specific model
     * in Laravel. It allows you to construct queries for retrieving and manipulating data from the
     * corresponding database table. In this context, the `scopeAllActive` method is a
     * 
     * @return Builder The `scopeAllActive` function is returning a query builder instance with a condition
     * applied to filter records where the `is_active` column is true.
     */
    public function scopeAllActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * The scopeFilterByName function filters records by name using a case-insensitive search term in PHP.
     * 
     * @param Builder query The `query` parameter is an instance of the
     * `Illuminate\Database\Eloquent\Builder` class, which represents a query builder for a specific model
     * in Laravel's Eloquent ORM. It allows you to construct queries for retrieving and manipulating data
     * from the corresponding database table.
     * @param string The `` parameter is a string that represents the term you want to
     * search for in the `name` column of your database table. The `ilike` operator is used for
     * case-insensitive pattern matching in PostgreSQL databases. The `"%{}%"` syntax is used to
     * 
     * @return Builder The `scopeFilterByName` function is returning a query builder instance with a
     * condition applied to filter records by the `name` column using a case-insensitive ILIKE comparison
     * with the provided search term.
     */
    public function scopeFilterByName(Builder $query, ?string $searchTerm): Builder
    {
        return $query->where('name', 'ilike', "%{$searchTerm}%");
    }

    /**
     * The function filters a query by a specified sale type name.
     * 
     * @param Builder The `query` parameter is a query builder instance that allows you to build and execute
     * queries against your database. In this context, it is used to filter results based on the sale type
     * name.
     * @param string The `scopeFilterBySaleType` function is a query scope used to filter the results
     * based on the `name` attribute of the `typeSale` relationship. The `saleTypeName` parameter is the
     * value that you want to filter by, i.e., the name of the sale type you are
     * 
     * @return Builder The `scopeFilterBySaleType` function is returning a query builder instance after
     * applying a filter based on the sale type name. It uses the `whereHas` method to filter the query
     * based on the relationship `typeSale` and the provided sale type name.
     */
    public function scopeFilterBySaleType(?Builder $query, ?string $saleTypeName): Builder
    {
        return             $query->whereHas('typeSale', function (Builder $q) use ($saleTypeName): Builder {
            return $q->where('name', $saleTypeName);
        });
    }

    /**
     * The function filters a query by a specified brand name.
     * 
     * @param Builder query The `query` parameter is an instance of the Laravel query builder
     * (`Illuminate\Database\Eloquent\Builder`). It is used to build and execute database queries for
     * retrieving data from the database.
     * @param brand The `scopeFilterByBrand` function is a query scope in Laravel that filters the query
     * results based on the brand name. It accepts two parameters:
     * 
     * @return Builder The `scopeFilterByBrand` function is returning a Builder instance after applying a
     * filter to query for records that have a specific brand name.
     */
    public function scopeFilterByBrand(Builder $query, ?string $brand): Builder
    {
        return $query->whereHas('brand', function (Builder $q) use ($brand): Builder {
            return $q->where('name', $brand);
        });
    }

    /**
     * The function filters a query by a primary class name.
     * 
     * @param Builder query The `query` parameter is an instance of the Laravel query builder
     * (`Illuminate\Database\Eloquent\Builder`). It is used to build and execute database queries for the
     * corresponding Eloquent model.
     * @param primaryClass The `scopeFilterByPrimaryClass` function is a query scope in Laravel that
     * filters the query results based on a given primary class name. It uses the `whereHas` method to
     * filter results based on a relationship.
     * 
     * @return Builder The `scopeFilterByPrimaryClass` function is returning a Builder instance after
     * applying a filter to the query based on the provided primary class name. It filters the query to
     * include only records that have a related primary class with the specified name.
     */
    public function scopeFilterByPrimaryClass(Builder $query, ?string $primaryClass): Builder
    {
        return $query->whereHas('primaryClass', function (Builder $q) use ($primaryClass): Builder {
            return $q->where('name', $primaryClass);
        });
    }

    /**
     * The function filters a query by category name using a whereIn clause.
     * 
     * @param Builder query The `query` parameter is an instance of the Laravel query builder
     * (`Illuminate\Database\Eloquent\Builder`) that represents the base query on which you want to apply
     * additional filtering based on categories.
     * @param string The `scopeFilterByCategory` function is a query scope in Laravel that filters the
     * query results based on the provided category or categories. The function takes two parameters:
     * 
     * @return Builder The `scopeFilterByCategory` function returns a Builder instance after applying a
     * filter to query records based on the provided category name(s).
     */
    public function scopeFilterByCategory(Builder $query, ?string $categories): Builder
    {
        $categories = $categories ? [$categories] : [];
        return $query->whereHas('categories', function (Builder $q) use ($categories): Builder {
            return $q->whereIn('name', $categories);
        });
    }

    /**
     * The function filters a query by genders based on the provided input.
     * 
     * @param Builder query The `query` parameter is an instance of the Laravel query builder
     * (`Illuminate\Database\Eloquent\Builder`). It is used to build and execute database queries for
     * retrieving data from a database table associated with a specific model.
     * @param string The `scopeFilterByGenders` function is a query scope in Laravel that filters the
     * query results based on the provided genders. The function takes two parameters:
     * 
     * @return Builder The `scopeFilterByGenders` function is returning a Builder instance after applying a
     * filter based on the provided genders. It checks if the genders parameter is not null, then converts
     * it into an array. It then uses the `whereHas` method to filter the query based on the 'name' column
     * in the 'genders' relationship table, matching the values in the genders array.
     */
    public function scopeFilterByGenders(Builder $query, ?string $genders): Builder
    {
        $genders = $genders ? [$genders] : [];
        return $query->whereHas('genders', function (Builder $q) use ($genders): Builder {
            return $q->whereIn('name', $genders);
        });
    }

    /**
     * The function `scopeFilterByCategoryOrGender` filters a query based on category or gender values
     * provided as strings.
     * 
     * @param Builder query The `scopeFilterByCategoryOrGender` function is a query scope that filters the
     * query based on categories and genders. It takes in the following parameters:
     * @param string The `scopeFilterByCategoryOrGender` function is a query scope in Laravel
     * that filters the query based on categories and genders. It takes two optional parameters:
     * `` and ``, which are strings representing the categories and genders
     * to filter by.
     * @param string The `scopeFilterByCategoryOrGender` function is a Laravel query scope that
     * filters the query based on the provided category and gender strings. The function checks if the
     * category and gender strings are not null, and then constructs arrays `` and ``
     * accordingly.
     * 
     * @return Builder The `scopeFilterByCategoryOrGender` function returns a Builder instance after
     * applying filtering conditions based on the provided category and gender strings. It constructs a
     * query that filters records based on the categories and genders specified in the input strings.
     */
    public function scopeFilterByCategoryOrGender(Builder $query, ?string $categoriesString, ?string $gendersString): Builder
    {
        $categories = $categoriesString ? [$categoriesString] : [];
        $genders = $gendersString ? [$gendersString] : [];
        return $query->where(function (Builder $query) use ($categories, $genders): void {
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

    /**
     * The function `scopeApplyParameters` filters a query based on multiple parameters such as brand,
     * primary class, category, and gender.
     * 
     * @param Builder query The `query` parameter is an instance of the `Builder` class, which is typically
     * used for building database queries in Laravel's Eloquent ORM. It represents a query builder instance
     * that allows you to construct and execute queries against a database table.
@param array $filterParameters The filter parameters array.
     * @return void
     */
    public function scopeApplyParameters(Builder $query, array $filterParameters): void
    {
        $query->filterByBrand($filterParameters['brand'])
            ->filterByPrimaryClass($filterParameters['primary_class'])
            ->filterByCategory($filterParameters['category'])
            ->filterByGenders($filterParameters['gender'])
            ->allActive();
    }

    /**
     * The function filters a query by price using a specified operator and price value.
     * 
     * @param Builder query The `` parameter is an instance of the Laravel query builder
     * (`Illuminate\Database\Eloquent\Builder`) that allows you to build and execute database queries in
     * your application. In this context, it is used to construct a query for filtering products by price.
     * @param string The `stringPrice` parameter is a string representing the price of a product. It
     * is then converted to a float value using `floatval()` in the `scopeFilterByPrice` method.
     * @param string The `operator` parameter in the `scopeFilterByPrice` function is used to specify
     * the comparison operator for the price filter. Common comparison operators include '=', '>', '<',
     * '>=', '<=', '<>', '!=', 'LIKE', 'NOT LIKE', 'IN', 'NOT IN', '
     * 
     * @return Builder The `scopeFilterByPrice` function is returning a Builder instance after applying a
     * filter based on the price and operator provided as arguments. The function converts the string price
     * to a float value, multiplies it by 100, and then filters the query based on the 'price' column using
     * the provided operator and the calculated product price.
     */
    public function scopeFilterByPrice(Builder $query, ?string $stringPrice, ?string $operator): Builder
    {
        $productPrice = floatval($stringPrice);
        return $query->where('price', $operator, $productPrice * 100);
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    public function productTypes(): BelongsToMany
    {
        return $this->belongsToMany(ProductType::class);
    }
}

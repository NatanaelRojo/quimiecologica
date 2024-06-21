<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Measure extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_active',
        'size',
        'quantity',
        'unit',
        'type',
    ];

    /**
     * The function `getNameAttribute` returns a formatted string based on the quantity, unit, and size
     * properties of an object.
     * 
     * @return string The `getNameAttribute` function returns a string that represents the quantity and
     * unit of an item. If the `size` attribute is not empty, it returns the `size` attribute value. If the
     * `quantity` attribute is not equal to 1, it appends the unit with an 's' suffix. Finally, it returns
     * a string combining the quantity and the unit (with 's'
     */
    public function getNameAttribute(): string
    {
        $presentationName = '';
        if ($this->size !== '') {
            return $this->size;
        }
        if ($this->quantity != 1) {
            $presentationName = "{$this->unit}s";
        }
        return "{$this->quantity} {$presentationName}";
    }

    /**
     * The products function establishes a many-to-many relationship between the current model and the
     * Product model in PHP.
     * 
     * @return BelongsToMany The `products()` method is returning a BelongsToMany relationship between the
     * current model (assuming this code is inside an Eloquent model class) and the `Product` model. This
     * indicates a many-to-many relationship where the current model can be associated with multiple
     * `Product` models and vice versa.
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}

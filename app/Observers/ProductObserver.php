<?php

namespace App\Observers;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductObserver
{
    /**
     * Handle the Product "created" event.
     */
    public function created(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "saved" event.
     */
    public function saved(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "updated" event.
     */
    public function updated(Product $product): void
    {
        if ($product->arrayAttributeIsDirty($product->image_urls)) {
            foreach ($product->dirtyArrayElements($product->image_urls) as $image_url) {
                Storage::disk('public')->delete($image_url);
            }
        }
    }

    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {
        if (!is_null($product->image_urls) && count($product->image_urls) > 0) {
            foreach ($product->image_urls as $image_url) {
                Storage::disk('public')->delete($image_url);
            }
        }
    }

    /**
     * Handle the Product "restored" event.
     */
    public function restored(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     */
    public function forceDeleted(Product $product): void
    {
        //
    }
}

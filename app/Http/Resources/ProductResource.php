<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'brand' => new BrandResource($this->brand),
            'primary_class' => new PrimaryClassResource($this->primaryClass),
            'category' => new CategoryResource($this->category),
            'gender' => new GenderResource($this->gender),
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'stock' => $this->stock,
            'price' => $this->price,
            'wholesale_price' => $this->wholesale_price,
            'image_urls' => $this->image_urls,
            'categories' => CategoryResource::collection($this->categories),
            'genders' => GenderResource::collection($this->genders),
            'type_sale' => new TypeSaleResource($this->typeSale),
            'product_content' => $this->quantity,
            'unit' => new UnitResource($this->unit),
        ];
    }
}

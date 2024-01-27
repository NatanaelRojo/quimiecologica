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
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'image_urls' => $this->image_urls,
            'created_at' => $this->created_at,
            'categories' => CategoryResource::collection($this->categories),
            'genders' => GenderResource::collection($this->genders),
        ];
    }
}

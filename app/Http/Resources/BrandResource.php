<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BrandResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'logo_url' => $this->logo_url,
            'name' => $this->name,
            'description' => $this->description,
            'primary_classes' => PrimaryClassResource::collection($this->primaryClasses),
        ];
    }
}

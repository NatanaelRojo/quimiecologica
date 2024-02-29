<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'banner' => $this->banner,
            'name' => $this->name,
            'description' => $this->description,
            'created_at' => $this->created_at,
            'conditions' => $this->conditions,
        ];
        // return parent::toArray($request);
    }
}

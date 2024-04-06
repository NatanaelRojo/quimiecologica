<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseRetailOrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'owner_firstname' => $this->owner_firstname,
            'owner_lastname' => $this->owner_lastname,
            'owner_id' => $this->owner_id,
            'owner_phone_number' => $this->owner_phone_number,
            'owner_state' => $this->owner_state,
            'owner_city' => $this->owner_city,
            'owner_address' => $this->owner_address,
            'total_price' => $this->total_price,
            'products' => ProductResource::collection($this->products),
        ];
    }
}

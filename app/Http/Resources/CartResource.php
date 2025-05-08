<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'quantity' => $this->quantity,
            'product' => [
                'id' => $this->product['id'] ?? null,
                'name' => $this->product['name'] ?? null,
                'price' => $this->product['price'] ?? null,
                'image_url' => $this->product['image_url'] ?? null,
                'description' => $this->product['description'] ?? null,

                'height' => $this->product['height'] ?? null,
                'width' => $this->product['width'] ?? null,
                'length' => $this->product['length'] ?? null,
                'weight' => $this->product['weight'] ?? null,
            ],
            'total' => $this->quantity * ($this->product['price'] ?? 0),
        ];
    }
}

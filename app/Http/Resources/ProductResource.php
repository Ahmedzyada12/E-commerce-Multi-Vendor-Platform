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
            'image' => $this->image,
            'name' => $this->name,
            'price' => $this->price,
            'inches' => $this->inches,
            'amount' => $this->amount,
            'description' => $this->description,
            'status' => $this->status,
            // Other product attributes
            'tag' => $this->tag ? explode(',', $this->tag) : null,
            'color' => $this->color ? explode(',', $this->color) : null,
            'size' => $this->size ? explode(',', $this->size) : null,
        ];
    }
}

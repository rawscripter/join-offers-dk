<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductImageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'imageId' => $this->id,
            'thumbImage' => $this->productThumbImage(),
            'featureImage' => $this->productFeatureImage(),
            'fullImage' => $this->productImage(),
        ];
    }
}

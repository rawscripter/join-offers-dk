<?php

namespace App\Http\Resources;

use App\ProductVariation;
use App\ProductVariationOption;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderVariationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $variationOption = ProductVariationOption::with('productVariation')->find($this['optionID']);

        return [
            'variation' =>  $variationOption,
        ];
    }
}

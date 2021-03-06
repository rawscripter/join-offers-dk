<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderShippingInfoResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'company_name' => $this->company_name,
            'cvr_number' => $this->cvr_number,
            'ean_number' => $this->ean_number,
            'address' => $this->address,
            'city' => $this->city,
            'zip_code' => $this->zip_code,
            'phone' => $this->phone,
            'shipping_method_details' => $this->shipping_method_details ? json_decode($this->shipping_method_details, true) : [],
        ];
    }
}

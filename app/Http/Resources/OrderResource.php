<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'custom_order_id' => $this->custom_order_id,
            'product' => new ProductResource($this->product),
            'quantity' => $this->quantity,
            'join_price' => $this->join_price,
            'total_price' => $this->total_price,
            'is_join_payment_enable' => $this->is_join_payment_enable,
            'is_join_offer_paid' => $this->is_join_offer_paid,
            'created_at' => Carbon::parse($this->created_at)->format('d F Y'),
        ];
    }
}

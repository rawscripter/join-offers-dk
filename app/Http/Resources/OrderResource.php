<?php

namespace App\Http\Resources;

use App\OrderShippingInfo;
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
            'variations' => $this->orderVariations(),// $this->variations ? json_decode($this->variations, true) : [],
            'variant_total' => $this->variant_total,
            'second_payment_amount' => $this->finalPaymentAmount(),
            'is_join_payment_enable' => $this->is_join_payment_enable,
            'is_join_price_paid' => $this->is_join_price_paid,
            'first_payment' => new OrderPaymentResource($this->firstPayment()),
            'customer' => (new CustomerResource($this->user)),
            'shipping_info' => (new OrderShippingInfoResource($this->shippingInfo)),
            'is_full_price_paid' => $this->is_full_price_paid ? true : false,
            'second_payment' => new OrderPaymentResource($this->secondPayment()),
            'order_status' => $this->order_status ? true : false,
            'is_canceled' => $this->is_canceled ? true : false,
            'created_at' => Carbon::parse($this->created_at)->format('d F Y'),
        ];
    }
}

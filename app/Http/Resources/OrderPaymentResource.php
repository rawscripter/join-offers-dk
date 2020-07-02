<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderPaymentResource extends JsonResource
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
            'order_id'=>$this->order_id,
            'type'=>$this->type,
            'status'=>$this->status,
            'amount'=>$this->amount,
            'created_at' => Carbon::parse($this->created_at)->format('d F Y'),
        ];
    }
}

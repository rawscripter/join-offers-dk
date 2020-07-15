<?php

namespace App;

use App\Http\Resources\OrderVariationResource;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function firstPayment()
    {
        return $this->hasOne(OrderPayment::class)->where('type', '=', 1)->first();
    }

    public function secondPayment()
    {
        return $this->hasOne(OrderPayment::class)->where('type', '=', 2)->first();
    }

    public function shippingInfo()
    {
        return $this->hasOne(OrderShippingInfo::class);
    }

    public function orderVariations()
    {
        if (empty($this->variations)) return [];
        $variations = json_decode($this->variations, true);
        return OrderVariationResource::collection($variations);
    }

    public function finalPaymentAmount()
    {
        $payAmount = $this->product->current_price;
        $total = $payAmount * $this->quantity;
        $total = $total - $this->join_price;
        if ($this->variant_total > 0) {
            $previousPaid = ($this->product->paymentPercentage() / 100) * $this->variant_total;
            $needToPay = $this->variant_total - $previousPaid;
            $total += $needToPay;
        }
        return $total;
    }
}

<?php

namespace App;

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

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderPayment extends Model
{
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Order::class);
    }
}

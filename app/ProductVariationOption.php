<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductVariationOption extends Model
{
    protected $guarded = [];

    public function productVariation()
    {
        return $this->belongsTo(ProductVariation::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    protected $guarded = [];

    public function options()
    {
        return $this->hasMany(ProductVariationOption::class);
    }
}

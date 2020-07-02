<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
     protected $fillable = ['image', 'user_id', 'product_id'];
//    protected $guarded = [];

    public function productThumbImage()
    {
        return env('APP_URL') . '/' . 'images/product/thumb/' . $this->image;
    }

    public function productFeatureImage()
    {
        return env('APP_URL') . '/' . 'images/product/feature/' . $this->image;
    }

    public function productImage()
    {
        return env('APP_URL') . '/' . 'images/product/' . $this->image;
    }
}

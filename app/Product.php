<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function mainImage()
    {
        return env('APP_URL') . '/' . 'images/product/feature/' . $this->image;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function productImages()
    {
        return $this->hasMany(ProductImage::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


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

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function isAuthUserLikedPost()
    {
        if (Auth::guard('api')->user()) {
            $userID = Auth::guard('api')->user()->id;
            $like = $this->likes()->where('user_id', $userID)->get();
            if ($like->isEmpty()) {
                return false;
            }
            return true;
        }
        return false;
    }

}

<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'icon', 'slug', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subCategories()
    {
        return $this->hasMany(SubCategory::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function runningProducts()
    {
        return $this->hasMany(Product::class)
            ->where('is_archive', 0)
            ->where('expire_date', '>', Carbon::now());
    }
}

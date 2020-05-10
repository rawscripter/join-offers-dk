<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function likedProducts()
    {
        return $this->belongsToMany(Product::class, 'likes');
    }

    public function info()
    {
        return $this->hasOne(UserInfo::class);
    }

    public function runningOrders()
    {
        return $this->hasMany(Order::class)
            ->where('is_canceled', '=', 0)
            ->where('order_status', '=', 0)
            ->orderByDesc('created_at');
    }

    public function completedOrders()
    {
        return $this->hasMany(Order::class)
            ->where('is_canceled', '=', 0)
            ->where('order_status', '=', 1)
            ->orderByDesc('created_at');
    }

    public function canceledOrders()
    {
        return $this->hasMany(Order::class)
            ->where('is_canceled', '=', 1);
    }


}

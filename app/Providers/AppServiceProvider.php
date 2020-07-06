<?php

namespace App\Providers;

use App\Observers\OrderPaymentObserver;
use App\Observers\UserObserver;
use App\OrderPayment;
use App\User;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);
        OrderPayment::observe(OrderPaymentObserver::class);
    }
}

<?php

use App\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

// to load admin dashboard
Route::get('/admin', function () {
    return view('admin.index');
});


// to load main site
Route::get('/', function () {
    return view('site.index');
});

// to load main site
Route::get('/delete/product', function () {
    for ($i = 67000; $i < 67047; $i++) {
        $product = \App\Product::find($i);
        if ($product) {
            if ($product->likes->count()) {
              continue;
            }
            if ($product->orders->count()) {
              continue;
            }
            $product->delete();
        }
    }
});


// to load main site
Route::get('/login', function () {
    return view('site.index');
})->name('login');

// to load main site
Route::get('/register', function () {
    return view('site.index');
});

//// to load main site
Route::get('/password/reset/{token}', function () {
    return view('site.index');
})->name('password.reset');


// for payment
Route::get('/checkout/payment/status', 'PaymentController@storePaymentDetails');


Route::post('sociallogin/{provider}', 'AuthController@SocialSignup');
Route::get('auth/{provider}/callback', 'OutController@index')->where('provider', '.*');


Route::get('/{any}', function (\Illuminate\Http\Request $request) {
    if ($request->is('admin/*')) {
        return view('admin.index');
    }
    return view('site.index');
});


Route::get('/{any}/{any1}', function (\Illuminate\Http\Request $request) {
    if ($request->is('admin/*')) {
        return view('admin.index');
    }
    return view('site.index');
});

Route::get('/{any}/{any1}/{any2}', function (\Illuminate\Http\Request $request) {
    if ($request->is('admin/*')) {
        return view('admin.index');
    }
    return view('site.index');
});

Route::get('/{any}/{any1}/{any2}/{any3}', function (\Illuminate\Http\Request $request) {
    if ($request->is('admin/*')) {
        return view('admin.index');
    }
    return view('site.index');
});


<?php

use App\Http\Controllers\PaymentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::group(['middleware' => ['auth:api']], function () {
    Route::get('/user', 'AuthController@user');
    Route::post('/user/update/password', 'AuthController@updatePassword');
    Route::get('/user/get/info', 'AuthController@getUserInfo');
    Route::post('/user/update/info', 'AuthController@updateInfo');
    // api for create new order
    Route::post('/order/create', 'OrderController@createTemporaryOrder');
    Route::post('/payment/{order}/full-payment', 'PaymentController@createFullPaymentId');
    Route::get('/order/{orderId}/details', 'OrderController@orderDetails');
    Route::post('/logout', 'AuthController@logout');
});

// apis for admin
Route::group(['middleware' => ['auth:api'], 'prefix' => 'admin'], function () {
    Route::get('/dashboard/data', 'AdminDashboardController@adminDashboardData');


    Route::resource('/category', 'CategoryController');
    Route::get('/category/{category}/sub-categories', 'CategoryController@subCategories');

    Route::resource('/product', 'ProductController');
    Route::get('/products/archive', 'ProductController@archiveProducts');
    Route::post('/product/{product}/restore', 'ProductController@restore');


    Route::get('/orders', 'OrderController@orders');
    Route::get('/order/{order}/details', 'OrderController@orders');

    Route::get('/customers', 'CustomerController@customers');


    Route::post('/product/{product}/upload/images', 'ProductController@uploadProductImages');
    Route::post('/product-image/{imageId}/delete', 'ProductController@deleteProductImage');
    Route::resource('/sub-category', 'SubCategoryController');


});

// apis for customer
Route::group(['middleware' => ['auth:api'], 'prefix' => 'customer'], function () {
    Route::get('/orders', 'OrderController@customerOrders');
});

// apis for site
Route::get('/categories', 'CategoryController@index');
Route::get('/products', 'ProductController@productsForSite');
Route::get('/favourites', 'ProductController@userFavouriteProductsForSite');
Route::get('/product/{slug}', 'ProductController@showProductForSite');

// favourite list
Route::get('/product/{slug}/favourite/add', 'ProductController@addToFavourite');
Route::get('/product/{slug}/favourite/remove', 'ProductController@removeFromFavourite');


Route::get('/product/{slug}/related-products', 'ProductController@showRelatedForSite');
Route::get('/category/{categorySlug}/products', 'CategoryController@products');
Route::get('/sub-category/{categorySlug}/products', 'SubCategoryController@products');
Route::get('/category/{categorySlug}/sub-categories', 'CategoryController@subCategoriesForSite');;


Route::post('/login', 'AuthController@login');
Route::post('/register', 'AuthController@register');

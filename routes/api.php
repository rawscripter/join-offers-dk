<?php

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
    Route::post('/logout', 'AuthController@logout');
});

// apis for admin
Route::group(['middleware' => ['auth:api'], 'prefix' => 'admin'], function () {
    Route::resource('/category', 'CategoryController');
    Route::get('/category/{category}/sub-categories', 'CategoryController@subCategories');
    Route::resource('/product', 'ProductController');
    Route::post('/product/{product}/upload/images', 'ProductController@uploadProductImages');
    Route::post('/product-image/{imageId}/delete', 'ProductController@deleteProductImage');
    Route::resource('/sub-category', 'SubCategoryController');
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
Route::get('/category/{categorySlug}/sub-categories', 'CategoryController@subCategoriesForSite');


Route::post('/login', 'AuthController@login');
Route::post('/register', 'AuthController@register');

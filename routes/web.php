<?php

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

// to load admin dashboard
Route::get('/admin/{any}', function () {
    return view('admin.index');
});
// to load admin dashboard
Route::get('/admin/{any}/{any1}', function () {
    return view('admin.index');
});

// to load main site
Route::get('/', function () {
    return view('site.index');
});

Route::get('/{any}', function () {
    return view('site.index');
});

Route::get('/{any}/{any1}', function () {
    return view('site.index');
});

Route::get('/{any}/{any1}/{any2}', function () {
    return view('site.index');
});

Route::get('/{any}/{any1}/{any2}/{any4}', function () {
    return view('site.index');
});

//Route::view('/{any}', 'site.index');
//Route::view('/{any}/{any1}', 'site.index');
//Route::view('/{any}/{any1}/{any2}', 'site.index');
//Route::view('/{any}/{any1}/{any2}/{any3}', 'site.index');


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
//Auth::routes();

Route::get('/', function () {
    return view('admin.index');
});



Route::view('/{any}','admin.index');
Route::view('/{any}/{any1}','admin.index');
Route::view('/{any}/{any1}/{any2}','admin.index');
Route::view('/{any}/{any1}/{any2}/{any3}','admin.index');


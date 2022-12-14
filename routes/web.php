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

Route::get('/', 'App\Http\Controllers\FoodController@listFood' );

Auth::routes();

Route::get('/', 'App\Http\Controllers\FoodController@listFood');

Auth::routes();




Route::resource('category','App\Http\Controllers\CategoryController')->middleware('auth');
Route::resource('food','App\Http\Controllers\FoodController')->middleware('auth');
Route::get('mail','App\Http\Controllers\FoodController@contact');

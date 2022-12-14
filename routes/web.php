<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('login','App\Http\Controllers\AuthController@loginView')->name('login.view');
Route::post('login','App\Http\Controllers\AuthController@authenticate')->name('login');

Route::get('register','App\Http\Controllers\AuthController@register');
Route::POST('store','App\Http\Controllers\AuthController@store');

Route::get('ajax-test','App\Http\Controllers\TestController@index');
Route::get('ajax-image-upload','App\Http\Controllers\TestController@uploadImageView');
Route::post('ajax-test','App\Http\Controllers\TestController@store');
Route::post('ajax-image-upload','App\Http\Controllers\TestController@imageUpload');

Route::post('ajax-image-upload2','App\Http\Controllers\TestController@imageUpload2');
Route::group(['middleware'=>'auth'],function(){
    Route::get('/dashboard','App\Http\Controllers\DashboardController@index');
    Route::get('logout','App\Http\Controllers\AuthController@logout');
});

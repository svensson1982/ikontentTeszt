<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//auth jwt

/**** Basket ****/
// archive basket
Route::get('/basket/archive', 'BasketController@archive')->name('basket.archive');
// show basket content
Route::get('/basket/{id}', 'BasketController@show')->name('basket.show');
// add to basket
Route::post('/basket/store', 'BasketController@store')->name('basket.store');
// delete from basket
Route::delete('/basket/destroy/{id}', 'BasketController@destroy')->name('basket.destroy');
// set paid
Route::post('/basket/setPaidItem', 'BasketController@setPaidItem')->name('basket.setPaidItem');

/***** JWT *****/
// here comes jwt
// Route::group(['middleware' => ['auth:api']], function () { });


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

Route::get('/restaurants/image/{path}','RestaurantController@getImage');
Route::post('/register','Auth\RegisterController@create');
Route::post('/login', 'Auth\LoginController@login');

Route::get('/states', 'AppController@getStates');
Route::get('/districts/{state_id}', 'AppController@getDistricts');


Route::middleware(['auth:api'])->group(function () {

    Route::post('/restaurants','RestaurantController@store');
    Route::get('/restaurants/{id}','RestaurantController@show');
    Route::get('/restaurants','RestaurantController@index');

    Route::post('/restaurants/{id}/cuisines','RestaurantController@storeCuisines');

    Route::post('/reviews','ReviewController@store');
    Route::get('/reviews/{restaurant_id}','ReviewController@index');
    Route::put('/reviews/{id}','ReviewController@update');
    Route::delete('/reviews/{id}','ReviewController@destroy');

    Route::delete('comments/{id}', 'CommentController@destroy');
    Route::post('comments','CommentController@store');

    Route::post('/vote','VotingController@store');
    Route::put('/profile/edit/{id}', 'UserController@update');

    Route::get('/restaurants/{id}/foods','FoodController@index');
    Route::post('/foods','FoodController@store');
    Route::put('/foods','FoodController@update');

    Route::post('/orders','RestaurantController@storeOrder');
    Route::get('/orders','UserController@myOrders');
    Route::delete('/orders/{id}','RestaurantController@cancelOrder');
});

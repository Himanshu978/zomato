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
    return 'you are logged in';
    return $request->user();
});

Route::post('/register','Auth\RegisterController@create');
Route::post('/login', 'Auth\LoginController@login');

Route::get('/states', 'AppController@getStates');
Route::get('/districts/{id}', 'AppController@getDistricts');


Route::middleware(['auth:api'])->group(function () {

    Route::post('/restaurants','RestaurantController@store');
    Route::get('/restaurants/{id}','RestaurantController@show');
    Route::get('/restaurants','RestaurantController@index');
    // Route::get('/restaurants/{id}/reviews','ReviewController@showRestaurantReviews');
    Route::get('/restaurants/{id}/reviews', 'ReviewController@showReviewsWithComments');
    Route::post('/restaurant/{id}/cuisines','RestaurantController@storeCuisines');

    Route::post('/reviews','ReviewController@store');
    // Route::get('/reviews/{id}', 'ReviewController@showReviewsWithComments');
    Route::get('/reviews','ReviewController@showUserReviews');
    Route::put('/reviews/{id}','ReviewController@update');
    Route::delete('/reviews/{id}','ReviewController@destroy');

  //  Route::post('/reviews/comment','ReviewController@storeComment');
    Route::delete('/reviews/comment/{id}', 'ReviewController@deleteComment');
    Route::post('/vote','VotingController@storeVote');
   // Route::post('/reviews/vote', 'ReviewController@vote');
  //  Route::post('/restaurants/vote', 'RestaurantController@voteImage');

    Route::post('comment','CommentController@storeComment');
    Route::put('comment/{id}','RestaurantController@updateComment');

    Route::put('/profile/edit/{id}', 'UserController@update');

    Route::get('/restaurants/{id}/foods','RestaurantController@showFoods');
    Route::post('/foods','FoodController@store');
    Route::put('/foods','FoodController@update');

    Route::post('/orders','RestaurantController@storeOrder');
    Route::get('/orders','UserController@myOrders');
    Route::delete('/orders/{id}','RestaurantController@cancelOrder');
});

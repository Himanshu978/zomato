<?php

namespace App\Tasks;

use App\Restaurant;
use App\Image;
use App\Order;
use App\OrderedFood;
use App\Comment;
use Illuminate\Support\Facades\Auth;

class RestaurantAPIProvider {

    public function getAll() {
        return Restaurant::all();
    }

    public function storeRestaurant($restaurantData) {

      //  dd($restaurantData);

        $restaurant =  Restaurant::create([
            'name' => $restaurantData['name'],
            'description' => $restaurantData['description'],
            'phone' => $restaurantData['phone'],
            'opening' => $restaurantData['opening'],
            'closing' => $restaurantData['closing'],
            'address_id' => $restaurantData['address_id'],
            'user_id' => 3,
        ]);

        if( $restaurantData['image_url']) {
            $restaurant->image()->create([
                'url' => $restaurantData['image_url']
            ]);
        }

        return $restaurant;

    }

    public function updateRestaurant($restaurantData) {


     /*
        Restaurant::w->image()->update([
                'url' => $restaurantData['image_url']
            ]);
        }
        */

        return Restaurant::update([
            'name' => $restaurantData['name'],
            'description' => $restaurantData['description'],
            'phone' => $restaurantData['phone'],
            'opening' => $restaurantData['opening'],
            'closing' => $restaurantData['closing'],
            'address_id' => $restaurantData['address_id'],
            'user_id' => 3,

        ]);

    }

    public function showRestaurant($id) {
        return Restaurant::findOrFail($id)->load('cuisines','address.district.state','image.restaurantComments.user','image.restaurantVotes');
    }

    public function showFoods($id) {
        return Restaurant::findOrFail($id)->load('foods');
    }

    public function storeComment($commentData) {
        $comment = new Comment();
        $comment->content = $commentData->content;
        $comment->user_id = auth()->user()->id;
        return Image::findOrFail($commentData->id)->restaurantComments()->save($comment);
    }

    public function updateComment($commentData, $id) {
        return Comment::find($id)
        ->where('user_id', auth()->user()->id)
        ->update([
            'content' => $commentData->content
        ]);
    }

    public function storeCuisines($cuisines, $id) {
        return Restaurant::findOrFail($id)->cuisines()->sync($cuisines->all(), false);
    }

    public function showReviewsWithComments($id) {
        return Restaurant::findOrFail($id)->reviews->load('comments.user','user','votes');
    }

    public function showRestaurantReviews($id) {
        return Restaurant::findOrFail($id)->reviews->load('user');
    }

    public function voteImage($voteData) {
        $votes = Image::findOrFail($voteData->id)->restaurantVotes();
        $exist = $votes->where('user_id', auth()->user()->id)->count();
        // If vote already exist alter the value
        if($exist) {
            return $votes->where('user_id', auth()->user()->id)
            ->delete();
        }
        //else insert the row
        else{
            return $votes->create([
                'user_id' => auth()->user()->id,
            ]);
        }

    }

    public function storeOrder($orderData) {
        $order = Restaurant::findOrFail($orderData->restaurant_id)
        ->orders()->create([
            'user_id' => auth()->user()->id,
            'status' => 1,
        ]);

    /* $orderedFoods = array(
             array('food_id' => 2),
             array('food_id' => 2),
             array('food_id' => 2),
             array('food_id' => 1)
         );
         */

        foreach ($orderData->orderedFoods as $orderedFood) {
            $selected[] = New OrderedFood($orderedFood);
        }

        return $order->orderedFoods()->saveMany($selected);

    }

    public function cancelOrder($order_id) {

        return Order::find($order_id)->where('user_id', auth()->user()->id)->update([
            'status' => 4
        ]);
    }

}

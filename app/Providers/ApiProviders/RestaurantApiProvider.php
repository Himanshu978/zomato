<?php

namespace App\Providers\ApiProviders;

use App\Restaurant;
use App\Image;
use App\Order;
use App\OrderedFood;
use App\Comment;
use App\Address;
use App\District;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Response;
use Log;
use DB;

use Illuminate\Support\Facades\Auth;

class RestaurantApiProvider
{

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll()
    {
        return Restaurant::all();
    }


    /**
     * @param $restaurantData
     * @return bool
     */
    public function update($restaurantData)
    {
        /*
           Restaurant::w->image()->update([
                   'url' => $restaurantData['image_url']
               ]);
           }
           */

        return Restaurant::update([
            'name'        => $restaurantData['name'],
            'description' => $restaurantData['description'],
            'phone'       => $restaurantData['phone'],
            'opening'     => $restaurantData['opening'],
            'closing'     => $restaurantData['closing'],
            'address_id'  => $restaurantData['address_id'],
            'user_id'     => 3,
        ]);

    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        $restaurant = Restaurant::findOrFail($id)->load('cuisines', 'address.district.state', 'image.restaurantComments.user', 'image.restaurantVotes');
        return $restaurant;
    }


    /**
     * @param $imagePath
     * @return mixed
     */
    public function getImage($imagePath)
    {
        return File::get(public_path($imagePath));
    }


    /**
     * @param array $cuisines
     * @param $id
     * @return mixed
     */
    public function addCuisines($cuisines, $id)
    {
        return Restaurant::findOrFail($id)->cuisines()->sync($cuisines->all(), false);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function showReviewsWithComments($id)
    {
        return Restaurant::findOrFail($id)->reviews->load('comments.user', 'user', 'votes');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function showReviews($id)
    {
        return Restaurant::findOrFail($id)->reviews->load('user');
    }

    /**
     * @param $voteData
     * @return mixed
     */
    public function voteImage($voteData)
    {
        $votes = Image::findOrFail($voteData['id'])->restaurantVotes();
        $exist = $votes->where('user_id', auth()->user()->id)->count();
        // If vote already exist alter the value
        if ($exist) {
            return $votes->where('user_id', auth()->user()->id)
                         ->delete();
        } //else insert the row
        else {
            return $votes->create([
                'user_id' => auth()->user()->id,
            ]);
        }

    }

    /**
     * @param $orderData
     * @return mixed
     */
    public function placeOrder($orderData)
    {
        $order = Restaurant::findOrFail($orderData->restaurant_id)
                           ->orders()->create([
                'user_id' => auth()->user()->id,
                'status'  => 1,
            ]);

//        foreach ($orderData->orderedFoods as $orderedFood) {
//            $selected[] = New OrderedFood($orderedFood);
//        }
        $attachArray = array();
        foreach ($orderData->orderedFoods as $orderedFood) {
            $attachArray[ $orderedFood['food_id']]  = array('qty' => $orderedFood['qty']);
        }

        return $order->foods()->attach($attachArray);

       // return $order->orderedFoods()->saveMany($selected);
    }

    /**
     * @param $order_id
     * @return mixed
     */
    public function cancelOrder($order_id)
    {
        return Order::find($order_id)->where('user_id', auth()->user()->id)->update([
            'status' => 4
        ]);
    }


}

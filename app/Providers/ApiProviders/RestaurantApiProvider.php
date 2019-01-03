<?php

namespace App\Providers\ApiProviders;

use App\Restaurant;
use App\Image;
use App\Order;
use App\OrderedFood;
use App\Comment;
use App\Address;
use App\District;
use Illuminate\Support\Facades\Storage;
use Response;
use Log;
use File;
use DB;

use Illuminate\Support\Facades\Auth;

class RestaurantApiProvider
{

    public function getAll()
    {
        return Restaurant::all();
    }

    public function create($restaurantData)
    {

        DB::beginTransaction();
        try {
            $address_id = $this->createAddress($restaurantData->district_id, $restaurantData->street_address);

            $data = $this->setData($restaurantData, $address_id);

            $restaurant = Restaurant::create($data);

            if($restaurantData->image) {
                $this->storeImage($restaurantData->image, $restaurant);
            }

            DB::commit();

            return $restaurant;
        } catch (\Exception $ex) {
            DB::rollback();
            return response()->json(['error' => $ex->getMessage()], 500);
        }

    }

    private function storeImage($file_data,$restaurant) {
        if ($file_data != "") {

            $pos          = strpos($file_data, ';');
            $type         = explode(':', substr($file_data, 0, $pos))[1];
            $type         = explode('/', $type);
            $file_name    = 'image_' . time() . '.' . 'jpg';

            $storage_path = public_path() .'/'. $file_name;

            file_put_contents($storage_path, $file_data);

            $restaurant->image()->create([
                'url' => $file_name
            ]);
        }
    }

    private function createAddress($district_id, $street_address) {
         $address = District::findOrFail($district_id)
                           ->addresses()->create([
                'street_address' => $street_address
            ]);
        return $address->id;
    }


    public function updateRestaurant($restaurantData)
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

    public function showRestaurant($id)
    {
        $restaurant = Restaurant::findOrFail($id)->load('cuisines', 'address.district.state', 'image.restaurantComments.user', 'image.restaurantVotes');

        return $restaurant;
    }

    public function getImage($imagePath)
    {
        return File::get(public_path($imagePath));
    }

    public function updateComment($commentData, $id)
    {
        return Comment::find($id)
                      ->where('user_id', auth()->user()->id)
                      ->update([
                          'content' => $commentData->content
                      ]);
    }

    public function storeCuisines($cuisines, $id)
    {
        return Restaurant::findOrFail($id)->cuisines()->sync($cuisines->all(), false);
    }

    public function showReviewsWithComments($id)
    {
        return Restaurant::findOrFail($id)->reviews->load('comments.user', 'user', 'votes');
    }

    public function showRestaurantReviews($id)
    {
        return Restaurant::findOrFail($id)->reviews->load('user');
    }

    public function voteImage($voteData)
    {
        $votes = Image::findOrFail($voteData->id)->restaurantVotes();
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

    public function storeOrder($orderData)
    {
        $order = Restaurant::findOrFail($orderData->restaurant_id)
                           ->orders()->create([
                'user_id' => auth()->user()->id,
                'status'  => 1,
            ]);

        foreach ($orderData->orderedFoods as $orderedFood) {
            $selected[] = New OrderedFood($orderedFood);
        }

        return $order->orderedFoods()->saveMany($selected);

    }

    public function cancelOrder($order_id)
    {

        return Order::find($order_id)->where('user_id', auth()->user()->id)->update([
            'status' => 4
        ]);
    }

    public function setData($restaurantData, $address_id) {
     return [
        'name'        => $restaurantData->name,
        'description' => $restaurantData->description,
        'phone'       => $restaurantData->phone,
        'opening'     => $restaurantData->opening,
        'closing'     => $restaurantData->closing,
        'address_id'  => $address_id,
        'user_id'     => auth()->user()->id
    ];
}
}

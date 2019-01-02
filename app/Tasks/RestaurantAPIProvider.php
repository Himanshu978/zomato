<?php

namespace App\Tasks;

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

use Illuminate\Support\Facades\Auth;

class RestaurantAPIProvider {

    public function getAll() {
        return Restaurant::all();
    }

    public function storeRestaurant($restaurantData) {

        $address =  District::findOrFail($restaurantData->district_id)
        ->addresses()->create([
          'street_address' => $restaurantData->street_address
        ]);

        $restaurant =  Restaurant::create([
            'name' => $restaurantData->name,
            'description' => $restaurantData->description,
            'phone' => $restaurantData->phone,
            'opening' => $restaurantData->opening,
            'closing' => $restaurantData->closing,
            'address_id' => $address->id,
            'user_id' => auth()->user()->id
        ]);

        $file_data = $restaurantData->image;


        if($file_data!=""){

            $pos  = strpos($file_data, ';');
            $type = explode(':', substr($file_data, 0, $pos))[1];
            $type = explode('/',$type);
            $file_name = '/image_'.time().'.'.'jpg';
            $storage_path =  public_path().$file_name;

           // \Log::debug("file_data".$file_data);
            \Log::debug("base_64 decode".base64_decode($storage_path));
            file_put_contents($file_name, $file_data);
          //  Storage::put($file_name, base64_decode($file_data));
            $restaurant->image()->create([
               'url' => $file_name
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
        $restaurant = Restaurant::findOrFail($id)->load('cuisines','address.district.state','image.restaurantComments.user','image.restaurantVotes');

        // $path = public_path().'/uploads/images/'.$fileName;
        // return $restaurant;
        // return base_path();
        // $image =  base64_encode(Storage::get($restaurant->image->url));
        // return $image;

        return $restaurant;
    }

    public function getImage($imagePath) {
        return File::get(public_path($imagePath));
       // return public_path($imagePath) ;
       // return Storage::download('public/'.$imagePath);
       // return base64_encode();
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

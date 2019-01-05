<?php

namespace App\Providers\ApiProviders;

use App\Food;
use App\Restaurant;
use Illuminate\Support\Facades\Auth;


/**
 * Class FoodApiProvider
 *
 * @package App\Providers\ApiProviders
 */
class FoodApiProvider {

    /**
     * @param $restaurant_id
     * @return mixed
     */
    public function getAll($restaurant_id) {
        return Restaurant::findOrFail($restaurant_id)->load('foods');
    }

    /**
     * @param $foodData
     * @return mixed
     */
    public function create($foodData){
        return Food::create([
            'name' => $foodData['name'],
            'description' =>  $foodData['description'],
            'price' =>  $foodData['price'],
            'cuisine_id' =>  $foodData['cuisine_id'],
            'restaurant_id' => $foodData['restaurant_id']
        ]);
    }

    /**
     * @param $foodData
     * @return bool
     */
    public function update($foodData){
        return Food::update([
            'name' => $foodData['name'],
            'description' =>  $foodData['description'],
            'price' =>  $foodData['price'],
            'cuisine_id' =>  $foodData['cuisine_id'],
        ]);
    }

}


<?php

namespace App\Tasks;

use App\Food;
use Illuminate\Support\Facades\Auth;


class FoodAPIProvider {

    public function storeFood($foodData){
        return Food::create([
            'name' => $foodData->name,
            'description' =>  $foodData->description,
            'price' =>  $foodData->price,
            'cuisine_id' =>  $foodData->cuisine_id,
            'restaurant_id' => $foodData->restaurant_id
        ]);
    }

    public function updateFood($foodData){
        return Food::update([
            'name' => $foodData->name,
            'description' =>  $foodData->description,
            'price' =>  $foodData->price,
            'cuisine_id' =>  $foodData->cuisine_id,
        ]);
    }

}


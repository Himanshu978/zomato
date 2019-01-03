<?php

namespace App\Providers\ApiProviders;

use App\Food;
use Illuminate\Support\Facades\Auth;


class FoodApiProvider {

    public function getAll($restaurant_id) {
        return Restaurant::findOrFail($restaurant_id)->load('foods');
    }

    public function create($foodData){
        return Food::create([
            'name' => $foodData->name,
            'description' =>  $foodData->description,
            'price' =>  $foodData->price,
            'cuisine_id' =>  $foodData->cuisine_id,
            'restaurant_id' => $foodData->restaurant_id
        ]);
    }

    public function update($foodData){
        return Food::update([
            'name' => $foodData->name,
            'description' =>  $foodData->description,
            'price' =>  $foodData->price,
            'cuisine_id' =>  $foodData->cuisine_id,
        ]);
    }

}


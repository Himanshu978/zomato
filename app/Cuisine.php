<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuisine extends Model
{
    public function foods() {
      return  $this->hasMany(Food::class);
    }

    public function restaurants() {
        return $this->belongsToMany(Restaurant::class,'cuisine_restaurants');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $gaurded = [];
    protected $fillable = ['name', 'description', 'price', 'cuisine_id', 'restaurant_id'];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function cuisine()
    {
        return $this->belongsTo(Cuisine::class);
    }

    public function orderdFoods()
    {
        return $this->hasMany(OrderedFood::class);
    }

}

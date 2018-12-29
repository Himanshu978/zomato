<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $gaurded = ['id'];

    protected $fillable = ['name','description','phone','opening','closing','address_id'];

    public function foods() {
      return  $this->hasMany(Food::class);
    }

    public function address() {
      return  $this->belongsTo(Address::class);
    }

    public function cuisines() {
      return  $this->belongsToMany(Cuisine::class,'cuisine_restaurants');
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function orders() {
        return $this->hasMany(Order::class);
    }

    public function reviews() {
        return $this->hasMany(Review::class);
    }
}

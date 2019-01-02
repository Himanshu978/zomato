<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = ['id'];

    public function orderedFoods() {
      return  $this->hasMany(OrderedFood::class);
    }

    public function user(){
       return $this->belongsTo(User::class);
    }

    public function restaurant() {
        return $this->belongsTo(Restaurant::class);
    }
}

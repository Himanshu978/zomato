<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderedFood extends Model
{
    protected $guarded = ['id'];

    public function order(){
      return  $this->belongsTo(Order::class);
    }

    public function food(){
        return  $this->belongsTo(Food::class);
      }


}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{

    protected $guarded = ['id'];

    public function votes() {
       return $this->morphMany(Vote::class,'voteable');
    }

    public function comments(){
      return $this->morphMany(Comment::class,'commenteable');
    }

    public function food(){
       return $this->belongsTo(Food::class);
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function restaurant(){
        return $this->belongsTo(Restaurant::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

}

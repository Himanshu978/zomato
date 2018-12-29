<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $guarded = ['id'];

    public function imageable() {
        return $this->morphTo();
    }

    public function restaurantComments() {
        return $this->morphMany(Comment::class, 'commenteable');
    }

    public function restaurantVotes() {
        return $this->morphMany(Vote::class, 'voteable');
    }


}

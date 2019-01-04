<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Image
 *
 * @package App
 */
class Image extends Model
{
    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function imageable() {
        return $this->morphTo();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function restaurantComments() {
        return $this->morphMany(Comment::class, 'commenteable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function restaurantVotes() {
        return $this->morphMany(Vote::class, 'voteable');
    }


}

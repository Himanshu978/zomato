<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Cuisine
 *
 * @package App
 */
class Cuisine extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function foods() {
        return  $this->hasMany(Food::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function restaurants() {
        return $this->belongsToMany(Restaurant::class,'cuisine_restaurants');
    }
}

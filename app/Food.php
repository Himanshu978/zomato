<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Food
 *
 * @package App
 */
class Food extends Model
{
    /**
     * @var array
     */
    protected $gaurded = [];
    /**
     * @var array
     */
    protected $fillable = ['name', 'description', 'price', 'cuisine_id', 'restaurant_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cuisine()
    {
        return $this->belongsTo(Cuisine::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderdFoods()
    {
        return $this->hasMany(OrderedFood::class);
    }

}

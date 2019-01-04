<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Restaurant
 *
 * @package App
 */
class Restaurant extends Model
{
    /**
     * @var array
     */
    protected $gaurded = ['id'];

    /**
     * @var array
     */
    protected $fillable = ['name', 'description', 'phone', 'opening', 'closing', 'address_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function foods() {
      return  $this->hasMany(Food::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function address() {
      return  $this->belongsTo(Address::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function cuisines() {
      return  $this->belongsToMany(Cuisine::class,'cuisine_restaurants');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders() {
        return $this->hasMany(Order::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reviews() {
        return $this->hasMany(Review::class);
    }
}

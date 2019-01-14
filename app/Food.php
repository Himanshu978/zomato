<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
    protected $guarded = ['id'];



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
     * @return BelongsToMany
     */
    public function orders() {
        return $this->belongsToMany(Order::class, 'foods_orders')->withPivot('qty')->withTimestamps();
    }

}

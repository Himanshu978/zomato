<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 *
 * @package App
 */
class Order extends Model
{
    /**
     * @var array
     */
    protected $guarded = ['id'];



    public function foods() {
        return $this->belongsToMany(Food::class, 'foods_orders')->withPivot('qty')->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
       return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function restaurant() {
        return $this->belongsTo(Restaurant::class);
    }
}

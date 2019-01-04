<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class OrderedFood
 *
 * @package App
 */
class OrderedFood extends Model
{
    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order(){
      return  $this->belongsTo(Order::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function food(){
        return  $this->belongsTo(Food::class);
      }


}

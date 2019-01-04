<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class State
 *
 * @package App
 */
class State extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function districts(){
       return $this->hasMany(District::class);
    }


}

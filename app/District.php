<?php

namespace App;


use Illuminate\Database\Eloquent\Model;


/**
 * Class District
 *
 * @package App
 */
class District extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function state() {
        return $this->belongsTo(State::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function addresses() {
        return $this->hasMany(Address::class);
    }
}

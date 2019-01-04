<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Address
 *
 * @package App
 */
class Address extends Model
{

    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users() {
        return $this->hasMany(Address::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function district() {
        return $this->belongsTo(District::class);
    }
}

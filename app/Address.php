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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function users()
    {
        return $this->morphedByMany(User::class, 'addressable');
    }

    public function restaurant()
    {
        return $this->morphedByMany(Restaurant::class, 'addressable');
    }

}

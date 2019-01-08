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
//    public function user() {
//        return $this->belongsTo(User::class);
//    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function district()
    {
        return $this->belongsTo(District::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function addressable()
    {
        return $this->morphTo();
    }

    public function restaurants()
    {
        return $this->belongsToMany(Restaurant::class);
    }
}

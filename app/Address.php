<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{

    protected $guarded = ['id'];

    public function users() {
        return $this->hasMany(Address::class);
    }
    public function district() {
        return $this->belongsTo(District::class);
    }
}

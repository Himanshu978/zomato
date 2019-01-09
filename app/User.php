<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 *
 * @package App
 */
class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * @var array
     */
    protected $guarded = ['id'];
   // protected $fillable = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /** todo: check this
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
//    public function address() {
//      return $this->hasOne(Address::class);
//    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function address()
    {
        return $this->morphOne(Address::class, 'addressable');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reviews(){
       return $this->hasMany(Review::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function votes() {
       return $this->hasMany(Vote::class);
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
    public function comments () {
       return $this->hasMany(Comment::class);
    }



    //---------------

    /**
     * @param $userData
     */
     public function updateUser($userData){
        dd($userData->firstname);
          auth()->user()->update([
            'firstname' => $userData->firstname,
            'lastname' => $userData->lastname,
            'age' => $userData->age,
            'phone' => $userData->phone
        ]);

    }
}

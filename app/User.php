<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

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


    public function address() {
      return $this->belongsTo(User::class);
    }

    public function reviews(){
       return $this->hasMany(Review::class);
    }

    public function votes() {
       return $this->hasMany(Vote::class);
    }

    public function orders() {
       return $this->hasMany(Order::class);
    }

    public function comments () {
       return $this->hasMany(Comment::class);
    }

    public function orderedFoods() {
        return $this->hasManyThrough(OrderedFood::class,Order::class);
    }


    //---------------
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

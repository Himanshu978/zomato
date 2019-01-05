<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Address;

class RegisterController extends Controller
{
    public $successStatus = 200;
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }



    /**
     * Create a new user instance after a valid registration.
     *
     * @param LoginRequest $data
     * @return \App\User
     */
    protected function create(RegisterRequest $data)
    {
//       $address_id = Address::create([
//            'street_address' => $data['street_address'],
//            'district_id' => $data['district_id']
//        ]);

        if(!$data['type']){
            $data['type'] = 1;
        }

        $user =  User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'age' => $data['age'],
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'phone' => $data['phone'],
            'type' => $data['type'],
            'password' => Hash::make($data['password']),
        ]);

        $user->address()->create([
            'street_address' => $data['street_address'],
            'district_id' => $data['district_id']
        ]);

        $success['token'] =  $user->createToken('MyApp')-> accessToken;
        $success['name'] =  $user->username;

        return response()->json(['success'=>$success], $this-> successStatus);

    }
}

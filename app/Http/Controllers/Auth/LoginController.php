<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class LoginController extends Controller
{

    public $successStatus = 200;
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request) {

        //return "hey";

        if( Auth::attempt( [
          'email' => $request->input('email'),
          'password' => $request->input('password')
        ], true )
      ){
          $user = Auth::user();
          $success['token'] =  $user->createToken('MyApp')->accessToken;
          $success['user'] = $user;
          return response()->json(['success' => $success], $this->successStatus);

      }
      else{
          return response()->json(['error'=>'Unauthorised'], 401);
      }



  }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateUserRequest;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param                           Integer  user id     $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $user = new User();

        return $user->updateUser($request->all());
    }


    /**
     * Returns the list of users's orders
     *
     * @return \Illuminate\Http\Response
     */
    public function myOrders()
    {
        return auth()->user()->load('orders.foods', 'orders.restaurant');
    }
}

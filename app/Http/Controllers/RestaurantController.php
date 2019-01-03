<?php

namespace App\Http\Controllers;

use App\Facades\Restaurant;
use Illuminate\Http\Request;
use App\Http\Requests\CreateOrderRequest;
use App\Http\Requests\CreateRestaurantRequest;
use App\Http\Requests\UpdateCommentRequest;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the restaurants.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Restaurant::getAll();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CreateRestaurantRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRestaurantRequest $request)
    {
        //   $validated = $request->validated();

        return Restaurant::createRestaurant($request);

    }

    /**
     * Display the specified restaurant.
     *
     * @param  Integer  Restaurant's Id   ->   $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Restaurant::showRestaurant($id);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CreateRestaurantRequest $request
     * @param                                             Integer  Restaurant's Id    ->     $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateRestaurantRequest $request, $id)
    {
        $validated = $request->validated();

        return Restaurant::updateRestaurant($validated);

    }


    /**
     * Store a newly created cuisine in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param                           Integer   Restaurant id  ->  $id
     * @return \Illuminate\Http\Response
     */
    public function storeCuisines(Request $request, $id)
    {
        return Restaurant::storeCuisines($request, $id);
    }

    /**
     * Store a newly created order in storage.
     *
     * @param  \App\Http\Requests\CreateOrderRequest $request
     * @return \Illuminate\Http\Response
     */
    public function storeOrder(CreateOrderRequest $request)
    {
        return Restaurant::storeOrder($request);
    }

    /**
     * Store a newly created order in storage.
     *
     * @param   Integer   order id   ->   $id
     * @return \Illuminate\Http\Response
     */
    public function cancelOrder($id)
    {
        return Restaurant::cancelOrder($id);
    }

    /**
     * Restaurant's Image
     *
     * @param   image storage path      $path
     * @return \Illuminate\Http\Response
     */
    public function getImage($path)
    {
        return Restaurant::getImage($path);
    }

}

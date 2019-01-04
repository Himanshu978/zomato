<?php

namespace App\Http\Controllers;

use App\Facades\Restaurant;
use App\Http\Requests\CreateCuisineRequest;
use App\Tasks\RestaurantTask;
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
        $restaurant = new RestaurantTask();
        return $restaurant->create($request);
    }


    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        return Restaurant::show($id);
    }


    /**
     * @param CreateRestaurantRequest $request
     * @param                         $id
     * @return mixed
     */
    public function update(CreateRestaurantRequest $request, $id)
    {
        $validated = $request->validated();

        return Restaurant::update($validated);

    }


    /**
     * @param CreateCuisineRequest $request
     * @param                      $id
     * @return mixed
     */
    public function addCuisines(CreateCuisineRequest $request, $id)
    {
        return Restaurant::addCuisines($request, $id);
    }

    /**
     * Store a newly created order in storage.
     *
     * @param  \App\Http\Requests\CreateOrderRequest $request
     * @return \Illuminate\Http\Response
     */
    public function placeOrder(CreateOrderRequest $request)
    {
        return Restaurant::placeOrder($request);
    }


    /**
     * @param $id
     * @return mixed
     */
    public function cancelOrder($id)
    {
        return Restaurant::cancelOrder($id);
    }


    /**
     * @param $path
     * @return mixed
     */
    public function getImage($path)
    {
        return Restaurant::getImage($path);
    }

}

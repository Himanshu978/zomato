<?php

namespace App\Http\Controllers;

use App\Facades\Restaurant;
use Illuminate\Http\Request;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\StoreRestaurantRequest;
use App\Http\Requests\UpdateCommentRequest;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRestaurantRequest $request)
    {
    //   $validated = $request->validated();

        return Restaurant::storeRestaurant($request);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Restaurant::showRestaurant($id);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRestaurantRequest $request, $id)
    {
        $validated = $request->validated();

        return Restaurant::updateRestaurant($validated);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function storeComment(StoreCommentRequest $request) {
        return Restaurant::storeComment($request);
    }

    public function updateComment(UpdateCommentRequest $request, $id){
        return Restaurant::updateComment($request, $id);
    }

    public function storeCuisines(Request $request, $id) {
        return Restaurant::storeCuisines($request, $id);
    }

    public function voteImage(Request $request) {
        return Restaurant::voteImage($request);
    }

    public function storeOrder(StoreOrderRequest $request) {
        return Restaurant::storeOrder($request);
    }

    public function cancelOrder($id) {
        return Restaurant::cancelOrder($id);
    }

    public function showFoods($id) {
        return Restaurant::showFoods($id);
    }

    public function getImage($path) {
        return Restaurant::getImage($path);
    }

}

<?php

namespace App\Http\Controllers;

use App\Facades\Food;
use Illuminate\Http\Request;
use App\Http\Requests\CreateFoodRequest;

class FoodController extends Controller
{

    /**
     * @param $id
     * @return mixed
     */
    public function index($id)
    {
        return Food::getAll($id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CreateFoodRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateFoodRequest $request)
    {
        return Food::create($request->all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CreateFoodRequest $request
     * @param  \App\Food                            $food
     * @return \Illuminate\Http\Response
     */
    public function update(CreateFoodRequest $request, Food $food)
    {
        return Food::update($request->all());
    }


}

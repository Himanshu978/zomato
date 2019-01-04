<?php

namespace App\Http\Controllers;

use App\Facades\Review;
use App\Facades\Restaurant;
use Illuminate\Http\Request;
use App\Http\Requests\CreateReviewRequest;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateReviewRequest;
use Auth;
use App\User;
use phpDocumentor\Reflection\Types\Integer;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  Integer $restaurant_id
     * @return \Illuminate\Http\Response
     */
    public function index($restaurant_id, $type = "restaurant")
    {
        if($type == "user"){
            return Review::showUserReviews();
        }
        else if( $type == "restaurant") {
            return Restaurant::showReviewsWithComments($restaurant_id);
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CreateReviewRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateReviewRequest $request)
    {
        return Review::store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Review $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        //
    }


    /**
     * @param UpdateReviewRequest $request
     * @param                     $id
     * @return mixed
     */
    public function update(UpdateReviewRequest $request, $id)
    {
        return Review::updateReview($request, $id);
    }


    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        return Review::deleteReview($id);
    }





}

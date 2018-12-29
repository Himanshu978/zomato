<?php

namespace App\Http\Controllers;

use App\Facades\Review;
use App\Facades\Restaurant;
use Illuminate\Http\Request;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateReviewRequest;
use Auth;
use App\User;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReviewRequest $request)
    {

       return Review::storeReview($request);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReviewRequest $request, $id)
    {
        return Review::updateReview($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Review::deleteReview($id);
    }

    public function showReviews($id){
        return Restaurant::showRestaurantReviews($id);
    }

    public function showUserReviews() {
        return Review::showUserReviews();
    }

    public function storeComment(StoreCommentRequest $request) {
        return Review::storeComment($request);
    }

    public function deleteComment($id) {
        return Review::deleteComment($id);
    }

    public function getComments($id) {
        return Review::getComments();
    }

    public function showReviewsWithComments($id){
        return Restaurant::showReviewsWithComments($id);
    }

    public function vote(Request $request) {
        return Review::vote($request);
    }

}

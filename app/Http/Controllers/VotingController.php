<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Facades\Review;
use App\Facades\Restaurant;
use App\Http\Requests\CreateVoteRequest;

class VotingController extends Controller
{
    /**
     * Stores the vote in the storage.
     *
     * @param  \App\Http\Requests\CreateVoteRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateVoteRequest $request) {

        if($request->type == 'review'){
            return Review::vote($request);
        }
        else if($request->type == 'restaurant') {
            return Restaurant::voteImage($request);
        }
    }
}

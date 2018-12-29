<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Facades\Review;
use App\Facades\Restaurant;
use App\Http\Requests\StoreVoteRequest;

class VotingController extends Controller
{
    public function storeVote(StoreVoteRequest $request) {


        if($request->type == 'review'){
            return Review::vote($request);
        }
        else if($request->type == 'restaurant') {
            return Restaurant::voteImage($request);
        }

    }
}

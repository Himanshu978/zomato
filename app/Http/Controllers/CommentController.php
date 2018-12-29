<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Facades\Review;
use App\Facades\Restaurant;
use App\Http\Requests\StoreCommentRequest;

class CommentController extends Controller
{
    public function storeComment(StoreCommentRequest $request) {


        if($request->type == 'review'){
            return Review::storeComment($request);
        }
        else if($request->type == 'restaurant') {
            return Restaurant::storeComment($request);
        }

    }
}

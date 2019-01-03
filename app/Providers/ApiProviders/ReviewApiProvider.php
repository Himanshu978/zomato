<?php

namespace App\Providers\ApiProviders;

use App\Restaurant;
use App\Review;
use App\Comment;
use Illuminate\Support\Facades\Auth;

class ReviewApiProvider {

    public function store($reviewData) {


        return Restaurant::findOrFail($reviewData->restaurant_id)->reviews()
        ->create([
            'content' => $reviewData['content'],
            'user_id' => auth()->user()->id
        ]);

    }

    public function update($reviewData, $id) {

        return Review::findOrFail($id)->where('user_id',auth()->user()->id)->update([
            'content' => $reviewData->content,
        ]);
    }

    public function showUserReviews(){
        return auth()->user()->reviews;
    }

    public function delete($id) {

        return Review::where('id',$id)->where('user_id', auth()->user()->id)->delete();
    }

    public function vote($voteData) {
        $votes = Review::findOrFail($voteData->id)->votes();
        $exist = $votes->where('user_id', auth()->user()->id)->count();
        // If vote already exist alter the value
        if($exist) {
            return $votes->where('user_id', auth()->user()->id)
            ->delete();
        }
        //else insert the row
        else{
            return $votes->create([
                'user_id' => auth()->user()->id,
            ]);
        }

    }

}

<?php

namespace App\Providers\ApiProviders;

use App\Restaurant;
use App\Review;
use App\Comment;
use Illuminate\Support\Facades\Auth;

class ReviewApiProvider {

    /**
     * @param $reviewData
     * @return mixed
     */
    public function store($reviewData) {


        return Restaurant::findOrFail($reviewData['restaurant_id'])->reviews()
        ->create([
            'content' => $reviewData['content'],
            'user_id' => auth()->user()->id
        ]);

    }

    /**
     * @param $reviewData
     * @param $id
     * @return mixed
     */
    public function update($reviewData, $id) {

        return Review::findOrFail($id)->where('user_id',auth()->user()->id)->update([
            'content' => $reviewData['content'],
        ]);
    }

    /**
     * @return mixed
     */
    public function showUserReviews(){
        return auth()->user()->reviews;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id) {

        return Review::where('id',$id)->where('user_id', auth()->user()->id)->delete();
    }

    /**
     * @param $voteData
     * @return mixed
     */
    public function vote($voteData) {
        $votes = Review::findOrFail($voteData['id'])->votes();
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

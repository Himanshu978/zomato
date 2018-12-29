<?php

namespace App\Tasks;

use App\Restaurant;
use App\Review;
use App\Comment;
use Illuminate\Support\Facades\Auth;

class ReviewAPIProvider {

    public function storeReview($reviewData) {


        return Restaurant::findOrFail($reviewData->restaurant_id)->reviews()
        ->create([
            'content' => $reviewData['content'],
            'user_id' => auth()->user()->id
        ]);

    }

    public function updateReview($reviewData, $id) {

        return Review::findOrFail($id)->where('user_id',auth()->user()->id)->update([
            'content' => $reviewData->content,
        ]);
    }



    public function showUserReviews(){
        return auth()->user()->reviews;
    }

    public function deleteReview($id) {

        return Review::where('id',$id)->where('user_id', auth()->user()->id)->delete();
    }

    public function storeComment($commentData) {

        $comment = new Comment();
        $comment->content = $commentData->content;
        $comment->user_id = auth()->user()->id;
        return Review::findOrFail($commentData->id)->comments()->save($comment);
    }

    public function deleteComment($id) {
        return Comment::where('id',$id)->where('user_id', auth()->user()->id)->delete();
    }

    public function getComments($id) {
        return Review::findOrFail($id)->comments;
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

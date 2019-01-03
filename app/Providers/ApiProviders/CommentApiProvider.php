<?php

namespace App\Providers\Api_Providers;

use App\Comment;
use App\Http\Requests\StoreCommentRequest;
use App\Review;
use App\Image;
use Illuminate\Support\Facades\Auth;


class CommentApiProvider
{
    public function getAll($id, $type)
    {
        if ($type == 'review') {

            return Review::findOrFail($id)->comments;
        } else if ($type == 'restaurant') {

        }
    }

    public function create(StoreCommentRequest $request)
    {
        $comment          = new Comment();
        $comment->content = $request->content;
        $comment->user_id = auth()->user()->id;

        if ($request->type == 'review') {
            return Review::findOrFail($request->id)->comments()->save($comment);
        } else if ($request->type == 'restaurant') {
            return Image::findOrFail($request->id)->restaurantComments()->save($comment);
        }

    }

    public function delete($id)
    {
        return Comment::where('id', $id)->where('user_id', auth()->user()->id)->delete();
    }

}

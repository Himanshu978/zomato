<?php

namespace App\Providers\Api_Providers;

use App\Comment;
use App\Http\Requests\CreateCommentRequest;
use App\Review;
use App\Image;
use Illuminate\Support\Facades\Auth;


/**
 * Class CommentApiProvider
 *
 * @package App\Providers\Api_Providers
 */
class CommentApiProvider
{
    /**
     * @param $id
     * @param $type
     * @return mixed
     */
    public function getAll($id, $type)
    {
        if ($type == 'review') {

            return Review::findOrFail($id)->comments;
        } else if ($type == 'restaurant') {

        }
    }

    /**
     * @param CreateCommentRequest $request
     * @return mixed
     */
    public function create(CreateCommentRequest $request)
    {
        $data             = $request->all();
        $comment          = new Comment();
        $comment->content = $data['content'];
        $comment->user_id = auth()->user()->id;

        if ($request->type == 'review') {
            return Review::findOrFail($data['id'])->comments()->save($comment);
        } else if ($request->type == 'restaurant') {
            return Image::findOrFail($data['id'])->restaurantComments()->save($comment);
        }

    }

    /**
     * @param $commentData
     * @param $id
     * @return mixed
     */
    public function updateComment($commentData, $id)
    {
        return Comment::find($id)
                      ->where('user_id', auth()->user()->id)
                      ->update([
                          'content' => $commentData->content
                      ]);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return Comment::where('id', $id)->where('user_id', auth()->user()->id)->delete();
    }

}

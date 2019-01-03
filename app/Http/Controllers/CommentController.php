<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Facades\Review;
use App\Facades\Restaurant;
use App\Facades\Comment;
use App\Http\Requests\CreateCommentRequest;

class CommentController extends Controller
{

    /**
     * Returns the list of Comments.
     *
     * @param  Integer  $id
     * @param  Comment's type  $type
     * @return \Illuminate\Http\Response
     */
    public function index($id, $type)
    {
        return Comment::getAll($id, $type);
    }

    /**
     * Stores the comment in the storage.
     *
     * @param  \App\Http\Requests\CreateCommentRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCommentRequest $request)
    {

        return Comment::create($request);

    }

    /**
     * Remove the comment from storage.
     *
     * @param  Integer      Comment Id   ->    $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Comment::delete($comment_id);
    }

}

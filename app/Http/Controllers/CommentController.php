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
     * @param $id
     * @param $type
     * @return mixed
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
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        return Comment::delete($id);
    }

}

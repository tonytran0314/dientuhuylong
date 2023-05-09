<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

use Illuminate\Support\Facades\Redirect;

use App\Http\Requests\Comment\AddCommentRequest;
use App\Http\Requests\Comment\EditCommentRequest;
use App\Http\Requests\Comment\DeleteCommentRequest;

class CommentController extends Controller
{
    // ========================================= POST ========================================= //
    public function add(AddCommentRequest $request) {
        $request->validated($request->all());

        $comment = new Comment;
        $comment->content = $request->content;
        $comment->user_id = $request->user_id;
        $comment->product_id = $request->product_id;
        $comment->save();

        return Redirect::route('product.detail', $request->product_slug);
    }

    public function edit(EditCommentRequest $request) {
        $request->validated($request->all());

        $comment = Comment::find($request->comment_id);
        $comment->content = $request->update_content;
        $comment->user_id = $request->user_id;
        $comment->product_id = $request->product_id;
        $comment->save();

        return Redirect::route('product.detail', $request->product_slug);

    }

    public function delete(DeleteCommentRequest $request) {
        $request->validated($request->all());
        
        Comment::where('id', $request->delete_comment_id)->delete();

        return Redirect::route('product.detail', $request->product_slug);
    }
}

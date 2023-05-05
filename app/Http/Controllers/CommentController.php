<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    // ========================================= POST ========================================= //
    public function add(Request $request) {
        $request->validate([
            'content' => 'required|regex:/^([a-zA-Z0-9ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềếểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\%\x3B\/\.\&\(\)\-\+\"\'\d,\s]+)$/',
            'user_id'=> 'required|numeric',
            'product_id' => 'required|numeric',
            'product_slug' => 'required|string'
        ]);

        $comment = new Comment;
        $comment->content = $request->content;
        $comment->user_id = $request->user_id;
        $comment->product_id = $request->product_id;
        $comment->save();

        return redirect(route('product.detail', $request->product_slug));
    }

    public function edit(Request $request) {
        $request->validate([
            'update_content' => 'required|regex:/^([a-zA-Z0-9ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềếểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\%\x3B\/\.\;\&\(\)\-\+\"\'\d,\s]+)$/',
            'user_id'=> 'required|numeric',
            'product_id' => 'required|numeric',
            'product_slug' => 'required|string',
            'comment_id' => 'required|numeric'
        ]);

        $comment = Comment::find($request->comment_id);
        $comment->content = $request->update_content;
        $comment->user_id = $request->user_id;
        $comment->product_id = $request->product_id;
        $comment->save();

        return redirect(route('product.detail', $request->product_slug));

    }

    public function delete(Request $request) {
        $request->validate([
            'product_slug' => 'required|string',
            'delete_comment_id' => 'required|numeric'
        ]);

        $id = $request->delete_comment_id;
        
        Comment::where('id', $id)->delete();

        return redirect(route('product.detail', $request->product_slug));
    }
}

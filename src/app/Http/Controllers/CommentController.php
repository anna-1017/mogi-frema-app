<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request, $item_id)
    {
        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        Comment::create([
            'user_id' => auth()->id(),
            'item_id'=>$item_id,
            'comment'=>$request->comment,
        ]);

        return back()->with('success', 'コメントを投稿しました');
    }
}

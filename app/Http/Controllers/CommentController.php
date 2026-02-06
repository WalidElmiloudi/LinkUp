<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;


class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $data = $request->validate([
            'content' => 'required|string',
        ]);

        $post->comments()->create([
            'content' => $data['content'],
            'user_id' => auth()->id(),
        ]);

        return back();
    }

    public function update(Request $request, Comment $comment)
    {
        abort_if($comment->user_id !== auth()->id(), 403);

        $data = $request->validate([
            'content' => 'required|string',
        ]);

        $comment->update($data);

        return back();
    }

    public function destroy(Comment $comment)
    {
        abort_if($comment->user_id !== auth()->id(), 403);

        $comment->delete();

        return back();
    }
}

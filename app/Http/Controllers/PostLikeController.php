<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostLikeController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function store(Post $post, Request $request)
    {
        if ($post->likedBy($request->user())) {
            return response(null, 409);
        }

        $post->likes()->create([
            'user_id' => $request->user()->id,
        ]);

        return back();
    }

    public function destroy(Post $post, Request $request)
    {
        // Go through the user into the user's like relationship where 'post_id' == post->id .
        // user()->likes() return the likes that user has created.
        // 'post_id' == post->id return the one like of this post which I want to delete.

        $request->user()->likes()->where('post_id', $post->id)->delete();
        return back();
    }
}

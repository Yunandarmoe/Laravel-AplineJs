<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;

class PostController extends Controller
{
    public function index()
    {
        return Post::all(); 
    }

    public function store(PostStoreRequest $request)
    { 
        $post = Post::create($request->only('title', 'body'));
        return response()->json($post, 200);
    }

    public function update(PostUpdateRequest $request, Post $post)
    {
        $post->update($request->only('title', 'body'));
        return response()->json($post, 200);
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json($post, 200);
    }
}

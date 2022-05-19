<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function index()
    {
        return Post::all(); 
    }

    public function store(Request $request)
    {
        Post::create([
            'title' => $request->title,
            'body' => $request->body,
        ]);
        return Post::all();
    }

    public function show($id)
    {
        Post::find($id);
        return Post::all();
    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        $post->update($request->only('title', 'body'));
        return Post::all();
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return Post::all();
    }
}

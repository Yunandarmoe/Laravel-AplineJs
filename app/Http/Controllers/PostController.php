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
        $post = Post::create([
            'title' => $request->title,
            'body' => $request->body,
        ]);   
        return response()->json($post, 200);
    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        $post->update($request->only('title', 'body'));
        return response()->json($post, 200);
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return response()->json($post, 200);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function index()
    {
        $posts = Post::get();
        return $posts;
    }
    public function show(Post $post)
    {
        // $posts = $post->songs;
        return $post;
    }
    public function good()
    {
        $posts = Post::get();
        return $posts;
    }
}

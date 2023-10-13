<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{

    //
    public function index()
    {
        // $user = auth()->user();
        // $users = User::get();
        // $posts = Post::get();
        // return $posts;
        $posts = Post::get();
        return PostResource::collection($posts);
    }
    // public function showPage(User $user)
    // {
    //     // // $posts = $post->songs;
    //     // // $user = auth()->user();
    //     // $posts = $user->posts;
    //     // return $posts;
    //     $user = auth()->user();
    //     $users = User::get();
    //     $posts = Post::get();
    //     return [$users,$posts];
    // }
    public function good()
    {
        $posts = Post::get();
        return $posts;
    }
    // public function show(Post $post)
    // {
    //     return $post;
    // }
    
}

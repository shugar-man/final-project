<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
    public function store(Request $request)
    {
        $user = auth()->user();
        // $user= User::where('name',$request->get('username'))->first();
        $request->validate([
            'name'=>['required','min:3','max:255'],
            'image_path' => ['required']
        ]);
        
        $name = $request->get('name');
        $exist = Post::where('name',$name)->first();
        if ($exist!== null) {
            abort(400,"Post name '{$name}' has been used");
        }

        $post = new Post();
        $post->name = $request->get('name');
        $post->user_id = $user->id;
        
        if ($request->hasFile('image_path')) {
            $file = $request->file('image_path');
            $fileName = $file->getClientOriginalName();
            $path = 'public/images/' . $fileName;
            Storage::disk('local')->put($path,file_get_contents($file));
            $post->image_path = $fileName;
            // บันทึกไฟล์รูปภาพลงใน folder ชื่อ 'artist_images' ที่ storage/app/public
            // $path = $request->file('image_path')->store('event_images', 'public');
            // $post->image_path = $path;
        }
        $post->save();
        // $post->refresh();

        // return [
        //     'to'=>url('api/artist' .artist->id)
        // ];
        return $post;
    }
    public function show(Post $post)
    {
        // return $post;
        return new PostResource($post);
    }
    
}

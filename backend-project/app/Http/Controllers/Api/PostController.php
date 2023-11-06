<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\PostTopic;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;

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

        $topics = $request->input('topic');
         
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
        }
        $post->save();
        


        if (!empty($topics)) {
            foreach ($topics as $topic) {
                $topicCheck = Topic::where('topic',$topic)->first();
                if (Topic::where('topic',$topic)->first()!=null) {
                    $postTopic = new PostTopic();
                    $tag= Topic::where('topic',$topic)->first();
                    $postTopic->topic_id = $tag->id;
                    $postTopic->post_id = $post->id;
                    $postTopic->save();
    
    
                }
                else {
                    $postTopic = new PostTopic();
                    $tag = new Topic();
                    $tag->topic = $topic;
                    $tag->save();
                    $postTopic->topic_id = $tag->id;
                    $postTopic->post_id = $post->id;
                    $postTopic->save();
                    
                }
                
            }
        }
        
        
        


        return $post;
    }
    public function show(Post $post)
    {
        // return $post;
        return new PostResource($post);
    }
    public function showtag($post) {
        
    }
    
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Http\Resources\TopicResource;
use App\Models\Post;
use App\Models\PostTopic;
use App\Models\Topic;
use Illuminate\Http\Request;

class PostTopicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PostTopic $postTopic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PostTopic $postTopic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PostTopic $postTopic)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PostTopic $postTopic)
    {
        //
    }
    public function postTag(Request $request,$post) {
        $postTopics = PostTopic::where('post_id',$post)->get();
        $topic = Topic::whereIn('id',$postTopics->pluck('topic_id'))->get();
        // return $subscribes;
        return TopicResource::collection($topic);

    }
    public function topic(Request $request,$topic) {
        $topic = Topic::where('topic',$topic)->first();
        // dd($topic);
        if ($topic==null)  {
            return 13123;
        }

        $postTopics = PostTopic::where('topic_id',$topic->id)->get();
        $post = Post::whereIn('id',$postTopics->pluck('post_id'))->get();
        return PostResource::collection($post);

    }
}

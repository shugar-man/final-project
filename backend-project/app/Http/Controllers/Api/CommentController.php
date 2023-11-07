<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CommentController extends Controller
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function comments(Request $request)
    {
        // dd($post);
        if (auth()->user()==null) {
            return response()->json(['message' => 'Unauthorized','success' => false,], Response::HTTP_CREATED);

        }
        $id = $request->get('id');
        $post = Post::where('id',$id)->first();
        $user = $request->get('user');
        $comment = new Comment();
        $comment->user_id = $user;
        $comment->post_id =$post->id;
        $text = $request->get('text');
        $comment->text = $text;
        $comment->save();

        return $comment;
    }

    public function showComments(Request $request){
        $post_id = $request->get('id');
        $paginatedComments = Comment::where('post_id',$post_id)->paginate(3);
        // return $paginatedComments;
        return CommentResource::collection($paginatedComments);
    }
}

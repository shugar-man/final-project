<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LikeController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:api', ['except' => []]);
    // }

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
        $post = Post::find(1);
        $like = Like::where('id',$id)->where('user_id',3)->get();
        return $like;
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
    public function like(Request $request, $post)
    {
        if (auth()->user()==null) {
            return response()->json(['message' => 'Unauthorized','success' => false,], Response::HTTP_CREATED);

        }
        
        $post = Post::where('id',$post)->first();
        $user = auth()->user();
        
        
        $like = new Like();
        $like->user_id = $user->id;
        $like->post_id =$post->id;
        $like->save();
        return $like;


        
    }
    public function showLike(string $post)
    {
        // $post = Post::find(1);
        // dd($post);
        $like = Like::where('post_id',$post)->get();
        // $like = Like::Where('user_id',1)->get();
        return $like;

        
    }

    public function likeStatus(Request $request, $post) {
        $user = auth()->user();
        if (auth()->user()==null) {
            return response()->json(['message' => 'Unauthorized','success' => false,], Response::HTTP_CREATED);

        }
        $likes = Like::where('post_id',$post)->get();
        foreach ($likes as $like) {
            if ($user->id==$like->user_id){
                return response()->json([
                    'success' => true,
                ], Response::HTTP_CREATED);
            }
            
            
                
        }
        return response()->json([
            'success' => false,
        ], Response::HTTP_CREATED);
        // return $subscribe;
    }
    public function unlike(Request $request, $post)
    {
        if (auth()->user()==null) {
            return response()->json(['message' => 'Unauthorized','success' => false,], Response::HTTP_CREATED);

        }
        
        $user = auth()->user();
        $like = Like::where('post_id',$post)->where('user_id',$user->id)->first();
        if ($like->delete()) {
            return 1234;
        }

        
        
        return $like;
    }

    public function getLikeTotal(Request $request){

        $id = $request->get('id');
        $likeTotal = Like::where('id',$id)->count();
        return $likeTotal;
    }

}

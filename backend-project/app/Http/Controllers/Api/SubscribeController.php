<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SubscribeResource;
use App\Http\Resources\UserResource;
use App\Models\Subscribe;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class SubscribeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $subscribes = Subscribe::get();
        // // return SubscribeResource::collection($subscribes);
        // return $subscribes;
        $user = auth()->user();
        if ($user == null) {
            return 1234;
        }
        $subscribes = Subscribe::where('user_id',$user->id)->get();
        if ($subscribes == null) {
            return 12;
        }
       
        $users = User::whereIn('id', $subscribes->pluck('subscribe_id'))->get();
        // return $subscribes;
        
        return UserResource::collection($users);
        


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
    public function show(Subscribe $subscribe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subscribe $subscribe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subscribe $subscribe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subscribe $subscribe)
    {
        //
    }

    public function subscribe(Request $request,$user2) {
        $user = auth()->user();
        if (auth()->user()==null) {
            return response()->json(['message' => 'Unauthorized','success' => false,], Response::HTTP_CREATED);

        }
        // dd($user2);
        $user2 = User::where('id',$user2)->first();
        $subscribe = new Subscribe();
        $subscribe->user_id = $user2->id;
        $subscribe->subscribe_id = $user->id;
        if ($subscribe->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Comment saved successfully ' . $user2->id,
                'comment_id' => $user2->id
            ], Response::HTTP_CREATED);
        }
        
    }
    public function sub(Request $request,$user2) {
        
        $user = auth()->user();
        if (auth()->user()==null) {
            // return response()->json([
            //     'success' => true,
            //     'message' => 'Comment saved successfully'
            // ], Response::HTTP_CREATED);
            return response()->json(['message' => 'Unauthorized','success' => false,], Response::HTTP_CREATED);

        }
        $user2 = User::where('id',$user2)->first();

        $subscribe = Subscribe::where('user_id',$user2->id)->get();
        foreach ($subscribe as $subscription) {
            if ($user->id===$subscription->subscribe_id){
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
    public function unfollow(Request $request,$user2){
        $user = auth()->user();
        if (auth()->user()==null) {
            return response()->json(['message' => 'Unauthorized','success' => false,], Response::HTTP_CREATED);
        }

        $user2 = User::where('id',$user2)->first();
        $subscribe = Subscribe::where('user_id',$user2->id)->where('subscribe_id',$user->id)->first();
        if ($subscribe->delete()) {
            return true;
        }
        return $subscribe;

    }
    public function showFollow(string $user)
    {
        // $post = Post::find(1);
        // dd($post);
        $subscribe = Subscribe::where('user_id',$user)->get();




        // $like = Like::Where('user_id',1)->get();
        return $subscribe;
        

        
    }
    

}

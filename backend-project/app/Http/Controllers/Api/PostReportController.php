<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PostReport;

class PostReportController extends Controller
{
    public function reportPost(Request $request)
    {
        $user = auth()->user();
    
        $postId = $request->input('post_id');
    
        $report = PostReport::where('user_id', $user->id)
            ->where('post_id', $postId)
            ->first();
    
        if (!$report) {
            PostReport::create([
                'user_id' => $user->id,
                'post_id' => $postId,
            ]);
    
            return response()->json(['message' => 'Post reported successfully']);
        }
    
        return response()->json(['message' => 'You have already reported this post.']);
    }
}

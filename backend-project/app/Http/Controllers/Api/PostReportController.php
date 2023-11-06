<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PostReport;
use App\Models\Post;

class PostReportController extends Controller
{
    public function reportPost(Request $request)
    {
        if (auth()->check()) {
            $user = auth()->user();
            $postId = $request->input('post_id');
    
            $report = PostReport::where('user_id', $user->id)
                ->where('post_id', $postId)
                ->first();
    
            if (!$report) {
                $existingReport = PostReport::where('post_id', $postId)->first();
    
                if (!$existingReport) {
                    PostReport::create([
                        'user_id' => $user->id,
                        'post_id' => $postId,
                    ]);
    
                    return response()->json(['message' => 'Post reported successfully']);
                } else {
                    return response()->json(['message' => 'Another user has already reported this post.']);
                }
            } else {
                return response()->json(['message' => 'You have already reported this post.']);
            }
        } else {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }
    public function getReportedPosts()
    {
        $reportedPosts = PostReport::select('users.id as user_id','posts.id', 'posts.name as post_name', 'users.name as user_name', 'users.profile_image as user_profile_image', 'posts.image_path as post_image_path')
            ->join('posts', 'post_reports.post_id', '=', 'posts.id')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->get();
    
        return response()->json($reportedPosts);
    } 
}

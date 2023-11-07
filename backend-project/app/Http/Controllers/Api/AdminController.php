<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use App\Models\PostReport;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function suspendUser(Request $request, User $user)
    {
        $user->update(['status' => false]);

        return response()->json(['message' => 'User suspended successfully']);
    }

    public function deletePost(Post $post)
    {
        try {
            $reports = PostReport::where('post_id', $post->id)->get();
            foreach ($reports as $report) {
                $report->delete();
            }

            $post->delete();

            return response()->json(['message' => 'Post and its associated reports deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while deleting the post and its reports'], 500);
        }
    }
    // public function cancelReport(Request $request){
    //     $post = $request->get('id');
    //     PostReport::where('post_id', $post)->get()->delete();
    //     return "cancel";
    // }

}

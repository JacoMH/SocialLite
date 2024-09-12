<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeDislikeController extends Controller
{
    public function upload(Request $request, $postID)
    {
        
    // Check if the like already exists
    $like = Like::where('user_id', Auth::id())->where('post_id', $postID)->first();

    if ($like) {
        // Delete like from database
        Like::where('user_id', Auth::id())->where('post_id', $postID)->delete();
        return redirect()->back()->with('LikeMessage', 'Unlike Made Successfully');
    } else {
        // If doesn't exist, then store and save like
        $like = new Like;
        $like->user_id = Auth::id();
        $like->post_id = $postID;

        $like->save();
        return redirect()->back()->with('LikeMessage', 'Like Made Successfully');
    }
    }
}

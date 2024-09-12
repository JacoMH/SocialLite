<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeDislikeController extends Controller
{
    public function upload(Request $request)
    {

        echo('hello');
        $request->validate([
            'postID' => 'required',
        ]);

        
    // Check if the like already exists
    $like = Like::where('user_id', Auth::id())->where('post_id', $request->postID)->first();

    if ($like) {
        // Delete like from database
        Like::where('user_id', Auth::id())->where('post_id', $request->postID)->delete();
        return response()->json(['message' => 'post unliked']);
    } else {
        // If doesn't exist, then store and save like
        $like = new Like;
        $like->user_id = Auth::id();
        $like->post_id = $request->postID;

        $like->save();
        return response()->json(['message' => 'post liked']);
    }
    }
}

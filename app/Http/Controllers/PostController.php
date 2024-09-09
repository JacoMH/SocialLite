<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\post;
use App\Models\User;
use App\Models\comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get posts
        $posts = DB::table('user_post')
        ->join('users', 'user_post.user_id', '=', 'users.id')
        ->select('user_post.*', 'users.ProfilePicture', 'users.name')
        ->get()
        ->map(function ($post){
            $post->updated_at = Carbon::parse($post->updated_at); //changes the string created by the STDclass to a carbon instance
            $post->created_at = Carbon::parse($post->created_at);
            return $post;
        });
        //get profiles who made the posts
        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //goes to the post create page

        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //validation
        $request->validate([
            'title' => 'required|max:120',
            'text' => 'required',
        ]);

        //stores post in table
        $post = new post;

        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->text = $request->text;

        $post->save();
        
        //returns with successful comment made
        return redirect()->back()->with('AlertMessage', 'Post Made Successfully');

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(post $post)
    {       
        //fetch comments here and send them with the post to the comments section
        $PostComment = DB::table('post_comments')
        ->join('users', 'post_comments.user_id', '=', 'users.id')
        ->select('post_comments.*', 'users.ProfilePicture', 'users.name')
        ->where('post_comments.post_id', '=', $post->id)
        ->latest() 
        ->get()
        ->map(function ($comment){
            $comment->updated_at = Carbon::parse($comment->updated_at);
            $comment->created_at = Carbon::parse($comment->created_at);
            return $comment;
        });

        //fetch post and user
        $UserPost = DB::table('user_post')
        ->join('users', 'user_post.user_id', '=', 'users.id')
        ->select('user_post.*', 'users.name', 'users.ProfilePicture', 'users.created_at')
        ->where('user_post.id', '=', $post->id)
        ->first();
        
        //changes from string to carbon instance
        if ($UserPost) {
            $UserPost->created_at = Carbon::parse($UserPost->created_at);
            $UserPost->updated_at = Carbon::parse($UserPost->updated_at);
            }

        return view('posts.comments', ['UserPost' => $UserPost, 'PostComment' => $PostComment]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(post $post)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

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
        $posts = post::latest('updated_at')->get();

        //get profiles who made the posts
        return view('posts.index')->with(['posts', $posts]);
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
        //fetch post profile
        $user = User::find($post->user_id)->select(['name', 'email', 'created_at', 'ProfilePicture'])->first();
        
        
        //fetch comments here and send them with the post to the comments section
        $PostComment = DB::table('post_comments')
        ->join('users', 'post_comments.user_id', '=', 'users.id')
        ->select('post_comments.*', 'users.ProfilePicture', 'users.name')
        ->where('post_comments.post_id', '=', $post->id)
        ->get();

        return view('posts.comments', ['post' => $post, 'PostComment' => $PostComment, 'user' => $user]);
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

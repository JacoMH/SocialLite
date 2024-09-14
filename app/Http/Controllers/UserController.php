<?php

namespace App\Http\Controllers;

use App\Models\post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke($id)
    {
        if (Auth::id() != $id) {
            $UserPost = DB::table('user_post')
            ->join('users', 'user_post.user_id', '=', 'users.id')
            ->select('user_post.*', 'users.name', 'users.ProfilePicture', 'users.created_at', 'users.email')
            ->where('user_post.user_id', '=', $id)
            ->get()
            ->map(function ($post){
                $post->updated_at = Carbon::parse($post->updated_at); //changes the string created by the STDclass to a carbon instance
                $post->created_at = Carbon::parse($post->created_at);
                return $post;
            });
            $profile = User::where('id', $id)->first();
            return view('User.index', ['UserPost' => $UserPost, 'profile' => $profile]);
        } 
        else {
            //load your user profile with your posts
            $UserPost = DB::table('user_post')
            ->join('users', 'user_post.user_id', '=', 'users.id')
            ->select('user_post.*', 'users.name', 'users.ProfilePicture', 'users.created_at', 'users.email')
            ->where('user_post.user_id', '=', $id)
            ->get()
            ->map(function ($post){
                $post->updated_at = Carbon::parse($post->updated_at); //changes the string created by the STDclass to a carbon instance
                $post->created_at = Carbon::parse($post->created_at);
                return $post;
            });

            $profile = User::where('id', $id)->first();
            return view('User.index', ['UserPost' => $UserPost, 'profile' => $profile]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dont use this one
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(post $post)
    {
        //
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

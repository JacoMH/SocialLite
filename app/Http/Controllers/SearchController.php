<?php

namespace App\Http\Controllers;

use App\Models\post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {

        //when i have the other part working to, if statement here depending on which chosen (users or posts)
        
        //search posts
        $Query = post::query()
            ->where('text', 'LIKE', "%{$request->search}%")
            ->orWhere('title', 'LIKE', "%{$request->search}%")
            ->get();

        return view('Users', ['Query' => $Query]);
    }

    public function displayAll() {
        //display all posts by default
        $posts = post::query()
        ->get();

        dd($posts);

        return view('Users/All', ['posts' => $posts]);
    }
}

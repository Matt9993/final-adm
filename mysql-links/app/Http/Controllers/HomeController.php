<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Calculate num of albums
        $dir = public_path('/images');
        $files = array_diff(scandir($dir), array('..', '.'));
        $albumNum = count($files);

        //Calculate num of posts
        $posts = \App\Post::orderBy('created_at','desc')->get();
        $numOfPosts = count($posts);

        return view('home',['albumsNum' => $albumNum, 'postsNum' => $numOfPosts]);
    }
}

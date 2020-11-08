<?php


namespace biscuit\package\Http\Controllers;


use biscuit\package\model\Post;
use Illuminate\Routing\Controller;

class blogsController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('id','desc')->get();

        return view('press::blogs',compact('posts'));
    }
}
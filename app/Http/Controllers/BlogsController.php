<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class BlogsController extends Controller
{
    public function index() {

        $data = array(
            'title' => "Blog Archive",
            'posts' => Post::orderBy('created_at', 'desc')->paginate(10),
        );
        return view('blog.index')->with($data);
    }

    public function show($slug) {
        try {
            $post = Post::where('slug', '=', $slug)->first();
            $data = array(
                'title' => $post->title,
                'posts' => Post::where('slug', '=', $slug)->first()
            );

            return view('blog.show')->with($data);
        } catch (\Exception $e) {
            return "404 Not Found";
        }

    }




}

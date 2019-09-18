<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PagesController extends Controller
{
    public function index() {
        $posts = Post::orderBy('created_at', 'desc')->limit(3)->get();
        $data = array(
            'title' => "Welcome to laravel app",
            'posts' => $posts
        );
        return view('pages.index')->with($data);
    }

    public function about() {
        $title="About Us";
        return view('pages.about')->with('title', $title);
    }

    public function services() {
        $data = array(
            'title' => "Our Services",
            'services' => ['web desgin', 'seo', 'Programming']
        );

        return view('pages.services')->with($data);
    }

    public function contact() {
        return view('pages.contact')->with('title', "Contact Us");
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;
use App\User;
use Image;
use Storage;

class PostsController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $data = array(
            'title' => "Posts",
            'posts' => $user->post()->orderBy('created_at', 'desc')->paginate(10)
        );

        return view('posts.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $data = array(
            'title' => "Create Post",
            'categories' => Category::orderBy('name', 'asc')->get(),
            'tags' => Tag::orderBy('name', 'asc')->get(),
        );
        return view('posts.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'title' => 'bail|required|unique:posts|between:5,100',
            'category' => 'bail|required|numeric',
            'body' => 'required',
            'featured_img' => 'sometimes|image'
        ]);

        // Store
        $post = new Post();
        $post->title = $request->title;
        $post->slug = str_slug($request->title);
        $post->category_id = $request->category;
        $post->body = $request->body;
        $post->user_id = auth()->user()->id;

        if ($request->hasFile('featured_img')) {
          $image = $request->file('featured_img');
          $filename = time() . '.' . $image->getClientOriginalExtension();
          $location = public_path('img/uploads/' . $filename);
          Image::make($image)
            ->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($location);
          $post->image = $filename;
        }

        $post->save();
        $post->tags()->sync($request->tags, false);

        // Redirect
        $message = "Your post has been created.";
        return redirect()->route('posts.show', $post->id)->with('success', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title = Post::find($id)->title;
        $post = Post::find($id);

        // User validation
        if (auth()->user()->id !==$post->user_id) {
            return redirect('/posts')->with('error', 'Not allowed');
        }

        // Output
        return view('posts.show')->with([
                'title' => $title,
                'posts' => $post
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = "Edit Post";
        $post = Post::find($id);

        $categories = Category::all();
        $cats = array();
        foreach ($categories as $category) {
            $cats[$category->id] = $category->name;
        }

        $tags = Tag::all();
        $tags2 = array();
        foreach ($tags as $tag) {
            $tags2[$tag->id] = $tag->name;
        }

        // User validation
        if (auth()->user()->id !==$post->user_id) {
            return redirect('/posts')->with('error', 'Not allowed');
        }

        // Output
        return view('posts.edit')->with([
            'title' => $title,
            'posts' => $post,
            'categories' => $cats,
            'tags' => $tags2,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        // user validation
        if (auth()->user()->id !==$post->user_id) {
            return redirect('/posts')->with('error', 'Not allowed');
        }

        $request->validate([
            'title' => 'bail|required|between:5,100',
            'slug' => "bail|required|alpha_dash|between:5,100|unique:posts,slug,$id",
            'body' => 'required',
            'featured_img' => 'image',
        ]);

        // Store
        $post->title = $request->input('title');
        $post->slug = $request->input('slug');
        $post->category_id = $request->input('category');
        $post->body = $request->input('body');

        if ($request->hasFile('featured_img')) {
            $image = $request->file('featured_img');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('img/uploads/' . $filename);
            Image::make($image)
                ->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($location);
            $oldImage = $post->image;
            $post->image = $filename;
            Storage::delete($oldImage);
        }

        $post->save();

        if (isset($request->tags)) {
            $post->tags()->sync($request->tags);
        } else {
            $post->tags()->sync(array());
        }

        // Redirect
        $message = "Your post has been updated.";
        return redirect()->route('posts.show', $post->id)->with('success', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->tags()->detach();
        Storage::delete($post->image);

        // validation
        if (auth()->user()->id !==$post->user_id) {
            return redirect('/posts')->with('error', 'Not allowed');
        }

        $post->delete();

        $message = "Your post has been deleted";
        return redirect()->route('posts.index')->with('success', $message);
    }
}

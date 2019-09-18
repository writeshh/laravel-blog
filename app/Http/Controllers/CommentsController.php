<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Post;
use App\User;

class CommentsController extends Controller
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
        //
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
    public function store(Request $request, $post_id)
    {
        // Validation
        $request->validate([
            'comment' => 'required|between:5,2000',
        ]);

        $post = Post::find($post_id);

        $comment = new Comment();
        $comment->comment = $request->comment;
        $comment->approved = true;
        $comment->user_id = auth()->user()->id;
        $comment->post()->associate($post);
        $comment->save();

        $title = "Blog";
        $message = "Your Comment has been added";
        return redirect()->route('blog.show', [$post->slug])->with('success', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment = Comment::find($id);
        return view('comments.edit')->with([
            'title' => 'Edit Comment',
            'comment' => $comment
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
        $comment = Comment::find($id);
        // Validation
        $request->validate([
            'comment' => 'required|between:5,2000',
        ]);

        $comment->comment = $request->comment;
        $comment->save();

        return redirect()->route('posts.show', $comment->post->id)->with('success', 'The comment has been edited');
    }

    public function delete($id){
        $comment = Comment::find($id);
        return view('comments.delete')->with([
            'title' => 'Delete Confirmation',
            'comment'=> $comment,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);
        $post_id = $comment->post->id;
        $comment->delete();
        return redirect()->route('posts.show', $post_id)->with([
            'success', 'Deleted Comment'
        ]);
    }
}

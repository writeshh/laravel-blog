<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\User;


class TagsController extends Controller
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
        //$tags = Tag::all();
        $title = "Tags";
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $tags = $user->tag()->orderBy('created_at', 'desc')->paginate(10);

        return view('tags.index')->with([
            'tags' => $tags,
            'title' => $title,
        ]);
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
        // Validation
        $request->validate([
            'name' => 'bail|required|unique:tags|between:3,100',
        ]);

        $tag = new Tag;
        $tag->name = $request->name;
        $tag->user_id = auth()->user()->id;
        $tag->save();

        $message = "Your tag has been created.";
        return redirect()->route('tags.index')->with('success', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tag = Tag::find($id);
        $title = Tag::find($id)->name;

        // User Validation
        if (auth()->user()->id !==$tag->user_id) {
            return redirect('/tags')->with('error', 'Not allowed');
        }

        // Output
        return view('tags.show')->with([
            'tags'=> $tag,
            'title'=> "Tag: ". $title
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
        $title = "Edit Tag";
        $tag = Tag::find($id);

        // User Validation
        if (auth()->user()->id !==$tag->user_id) {
            return redirect('/tags')->with('error', 'Not allowed');
        }

        return view('tags.edit')->with([
            'tag'=>$tag,
            'title'=>$title,
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
        $tag = Tag::find($id);

        // Validation
        $request->validate([
            'name' => 'bail|required|between:3,100',
        ]);

        // User Validation
        if (auth()->user()->id !==$tag->user_id) {
            return redirect('/tags')->with('error', 'Not allowed');
        }

        $tag->name = $request->name;
        $tag->save();


        return redirect()->route('tags.show', $tag->id)->with('success', 'Your tag has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = Tag::find($id);
        $tag->posts()->detach();

        // User Validation
        if (auth()->user()->id !==$tag->user_id) {
            return redirect('/tags')->with('error', 'Not allowed');
        }

        $tag->delete();

        return redirect()->route('tags.index')->with('success', 'Your tag was deleted.');
    }
}

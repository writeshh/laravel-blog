<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\User;

class CategoriesController extends Controller
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
            'title' => 'Categories',
            'categories' => $user->category()->orderBy('created_at', 'desc')->paginate(10)
        );

        return view('categories.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()->route('categories.index');
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
            'name' => 'bail|required|unique:categories|between:3,100',
        ]);

        // Store
        $category = new Category();
        $category->name = $request->name;
        $category->user_id = auth()->user()->id;
        $category->save();

        // Redirect
        $message = "Your category has been created.";
        return redirect()->route('categories.index')->with('success', $message);
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
        $title =  "Edit Category";
        $category = Category::find($id);

        // validation
        if (auth()->user()->id !==$category->user_id) {
            return redirect('/categories')->with('error', 'Not allowed');
        }

        return view('categories.edit')->with([
            'title' => $title,
            'category' => $category
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
        // validation
        $category= Category::find($id);

        // validation
        if (auth()->user()->id !==$category->user_id) {
            return redirect('/categories')->with('error', 'Not allowed');
        }

        $request->validate([
            'name' => 'bail|required|between:3,100'
        ]);

        // Store
        $category = Category::find($id);
        $category->name = $request->input('name');
        $category->save();

        // Redirect
        $message = "Your category has been updated.";
        return redirect()->route('categories.index', $category->id)->with('success', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // validation
        if (auth()->user()->id !==$category->user_id) {
            return redirect('/categories')->with('error', 'Not allowed');
        }
    }
}

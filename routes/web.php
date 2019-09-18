<?php

use App\User;
use App\Post;
use Illuminate\Support\Facades\Input;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Users



// Blogs
Route::get('blog/{slug}', ['as' => 'blog.show', 'uses' => 'BlogsController@show'])->where('slug', '[\w\d\-\_]+');
Route::get('blog', ['as' => 'blog.index', 'uses' => 'BlogsController@index']);

// Posts
Route::resource('posts', 'PostsController');

// Categories
Route::resource('categories', 'CategoriesController');

// Tags
Route::resource('tags', 'TagsController', ['except' => ['create']]);


// Comments
Route::post('comments/{post_id}', ['uses' => 'CommentsController@store', 'as' => 'comments.store']);
Route::get('comments/{id}/edit', ['uses' => 'CommentsController@edit', 'as' => 'comments.edit']);
Route::put('comments/{id}', ['uses' => 'CommentsController@update', 'as' => 'comments.update']);
Route::delete('comments/{id}', ['uses' => 'CommentsController@destroy', 'as' => 'comments.destroy']);
Route::get('comments/{id}/delete', ['uses' => 'CommentsController@delete', 'as' => 'comments.delete']);


// Pages
Route::get('/', 'PagesController@index');
Route::get('about', 'PagesController@about');
Route::get('services', 'PagesController@services');
Route::get('contact', 'PagesController@contact');

// User & Authentication
Auth::routes();
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');


// Search
Route::any('/search', function(){
    $q = Input::get('query');
    if ($q != "") {
        $post = Post::where('title', 'LIKE', '%'. $q .'%')
                ->orWhere('body', 'LIKE', '%'. $q .'%')
                ->get();
        if(count($post) > 0){
            return view('search')->with([
                'posts' => $post,
                'title' => "Search Results"
                ])->withQuery($q);

        } else {
            return view('search')->with([
                'title' => 'Search Results',
                'error' => 'Sorry, no result found with keyword: "'. $q .'" Please try again !',
            ]);
        }
    }
});

@extends('layouts.app')

@section('content')
        <div class="octo-content">
    		<div class="container">
                <div class="jumbotron">
                    <h1 class="display-4">Hello, welcome to dashboard</h1>
                    <p class="lead">This is the dashboard for registered users, Here you can create post, categories and comment on other posts.</p>
                    <hr class="my-4">
                    <div class="text-center">
                        <a class="btn btn-primary btn-lg" href="/posts/create" role="button">Start Creating Post</a>
                    </div>
                </div>
                <div class="row">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="circle-text col-sm circle-1">
                        <div>
                            <h2 class="text-light">{{ count($user->post) }} Posts</h2>
                            <a class="text-light" href="/posts">View All Posts</a>
                        </div>
                    </div>

                    <div class="circle-text col-sm circle-2">
                        <div>
                            <h2 class="text-light">{{ count($user->category) }} Categories</h2>
                            <a class="text-light" href="/categories">View all Categories</a>
                        </div>
                    </div>


                    <div class="circle-text col-sm circle-3">
                        <div>
                            <h2 class="text-light">{{ count($user->comment) }} Comments</h2>
                        </div>
                    </div>
                </div>

            </div>
        </div>

@endsection

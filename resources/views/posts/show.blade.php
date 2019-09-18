@extends('layouts.app')

@section('title', ' | Blog Post '. $title)


@section('content')
    <div class="octo-content">
		<div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-body bg-light shadow p-3 mb-5 bg-white rounded">
                        <span>
                            @foreach ($posts->tags as $tag)
                                <span class="badge badge-primary">{{ $tag->name }}</span>
                            @endforeach
                        </span>

                        <p class="lead">{!! $posts->body !!}</p>
                    </div>

                    <div class="card card-body bg-light shadow p-3 mb-5 bg-white rounded">
                        <h3>Total Comments: {{$posts->comments()->count()}}</h3>
                        @if ($posts->comments()->count() > 0)
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Comment</th>
                                        <th scope="col">Written on</th>
                                        <th scope="col" width="105px"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($posts->comments as $comment)
                                        <tr>
                                            <th scope="row">{{ $comment->id }}</th>
                                            <td>{{ $comment->user->name}}</td>
                                            <td>{{ $comment->comment }}</td>
                                            <td>{{ date('d M Y', strtotime($comment->created_at)) }}</td>
                                            <td><a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-warning"><i class="fas fa-pen-square"></i></a>
                                                <a href="{{ route('comments.delete', $comment->id) }}" class="btn btn-danger"><i class="far fa-trash-alt"></i></a> </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            @else
                                <p>No Comments Found</p>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card card-body bg-light shadow p-3 mb-5 bg-white rounded">
                            <div class="row mb-2">
                                <div class="col-sm">
                                    <img src="{{ asset('img/uploads/'. $posts->image) }}" width="315px" alt="">
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm">
                                    <strong>URL:</strong>
                                    <p><a href="{{ url('blog/'.$posts->slug) }}">{{ url('blog/'.$posts->slug) }}</a></p>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm">
                                    <strong>Category:</strong>
                                    <p>{{ $posts->category->name }}</p>
                                </div>
                            </div>


                            <div class="row mb-2">
                                <div class="col-sm">
                                    <strong>Last Upated:</strong>
                                    <p>{{ $posts->updated_at }}</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm">
                                    <strong>Created On:</strong>
                                    <p>{{ $posts->created_at }}</p>
                                </div>
                            </div>

                            <hr>
                            <div class="row">
                                <div class="col-sm-6">
                                    <a href="{{ route('posts.edit' , $posts->id) }}" class="btn btn-primary btn-block">Edit</a>
                                </div>

                                <div class="col-sm-6">
                                    <form class="" action="{{ route('posts.destroy', $posts->id) }}" method="post" data-parsley-validate="">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submut" class="btn btn-danger btn-block" name="button">Delete</button>
                                    </form>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-sm-12">
                                    <a href="/posts" class="btn btn-secondary btn-block"><< See All Posts</a> <br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>


@endsection

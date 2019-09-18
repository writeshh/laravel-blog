@extends('layouts.app')

@section('title', ' | '. $title)

@section('content')
    <div class="octo-content">
		<div class="container">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Body</th>
                                <th scope="col">Created at</th>
                                <th scope="col">Last Updated</th>
                                <th scope="col"><a class="btn btn-success" href="/posts/create">Create New</a></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($posts) > 0)
                                @foreach ($posts as $post)
                                    <tr>
                                        <th scope="row">{{ $post->id }}</th>
                                        <td>{{ $post->title }}</td>
                                        <td>{{ strip_tags(substr($post->body, 0, 50)) }} {{ strlen($post->body) > 50 ? "..." : ""  }}</td>
                                        <td>{{ date('d M Y', strtotime($post->created_at)) }}</td>
                                        <td>{{ date('d M Y', strtotime($post->updated_at)) }}</td>
                                        <td> <a class="btn btn-primary" href="{{ route('posts.show', $post->id) }}">View</a> <a class="btn btn-warning" href="{{ route('posts.edit' , $post->id) }}">Edit</a> </td>
                                    </tr>
                                @endforeach
                            @else
                                <h3 class="lead">No Post(s) Found.</h3>
                            @endif
                        </tbody>
                    </table>

                </div>
            </div>
            <div class="text-center">
                {{ $posts->currentPage() }} of {{ $posts->lastPage() }} results

                {{ $posts->links() }}
            </div>

        </div>
    </div>
@endsection

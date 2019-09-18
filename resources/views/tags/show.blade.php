@extends('layouts.app')

@section('title', " | $title")


@section('content')

    <div class="octo-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-body bg-light shadow p-3 mb-5 bg-white rounded">
                        <h3 class="lead">{!! $tags->name !!}</h3>
                    </div>

                    <div class="posts">
                        @if (count($tags->posts) > 0)
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Tags</th>
                                        <th scope="col">~</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <h3 class="lead">List of posts that uses tag - <strong>"{{$tags->name}}"</strong></h3>
                                    @foreach ($tags->posts as $post)
                                        <tr>
                                            <th scope="row">{{ $post->id }}</th>
                                            <td>{{ $post->title }}</td>
                                            <td>{{ $post->category->name }}</td>
                                            <td>@foreach ($post->tags as $tag)
                                                <span class="badge badge-primary">{{ $tag->name }}</span>
                                            @endforeach</td>
                                            <td><a class="btn btn-primary" href="{{ url('blog/'.$post->slug) }}">View</a> </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <h3 class="lead">No Posts Found</h3>
                        @endif
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-body bg-light shadow p-3 mb-5 bg-white rounded">

                        <div class="row mb-2">
                            <div class="col-sm">
                                <strong>Tag Used:</strong>
                                <p>{{ $tags->posts->count() }} time(s)</p>
                            </div>
                        </div>


                        <div class="row mb-2">
                            <div class="col-sm">
                                <strong>Last Upated:</strong>
                                <p>{{ $tags->updated_at }}</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm">
                                <strong>Created On:</strong>
                                <p>{{ $tags->created_at }}</p>
                            </div>
                        </div>

                        <hr>
                        <div class="row">
                            <div class="col-sm-6">
                                <a href="{{ route('tags.edit' , $tags->id) }}" class="btn btn-primary btn-block">Edit</a>
                            </div>

                            <div class="col-sm-6">
                                <form class="" action="{{ route('tags.destroy', $tags->id) }}" method="post" data-parsley-validate="">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submut" class="btn btn-danger btn-block" name="button">Delete</button>
                                </form>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-sm-12">
                                <a href="/tags" class="btn btn-secondary btn-block"><< See All Tags</a> <br>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

@endsection

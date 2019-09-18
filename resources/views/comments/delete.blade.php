@extends('layouts.app')

@section('title', ' | '. $title)

@section('content')
    <div class="octo-content">
        <div class="container">

            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <h1>DELETE THIS COMMENT?</h1>
                    <p><strong>Comment: </strong> {{ $comment->comment }}</p>
                    <p><strong>Posted On: </strong>{{ $comment->post->title }}</p>
                    <p></p>
                    <form class="" action="{{ route('comments.destroy', $comment->id) }}" method="post" data-parsley-validate="">
                        @csrf
                        @method('DELETE')
                        <button type="submut" class="btn btn-danger" name="button">Yes Delete It</button>
                        <a class="btn btn-secondary" href="{{ route('posts.show', $comment->post->id) }}">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

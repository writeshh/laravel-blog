@extends('layouts.app')

@section('title', ' | Blog: '. $posts->title)


@section('content')
    <div class="octo-content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <img src="{{ asset('img/uploads/'. $posts->image) }}" width="100%" alt="{{ $posts->title }}">
                </div>
                <div class="col-md-12">
                    <p>Written <strong>{{ $posts->created_at->diffForHumans() }}</strong> on <strong>{{ $posts->category->name}}</strong>  by <strong>{{ $posts->user->name }} </strong></p>
                    <hr>
                    <span>
                        @foreach ($posts->tags as $tag)
                            <span class="badge badge-primary">{{ $tag->name }}</span>
                        @endforeach
                    </span>
                    <p class="lead">{!! $posts->body !!}</p>
                </div>
            </div>
            <hr>

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-body bg-light shadow p-5 mb-5 bg-white rounded">
                        @if (count($posts->comments) > 0)
                            <h3 class="lead text-center mb-5">{{ count($posts->comments). ' thoughts on "' . $posts->title.'"'}}</h3>
                            @foreach ($posts->comments as $comment)
                                <div class="shadow-none p-5 mb-5 bg-light rounded">
                                    <div class="comments">
                                        <div class="author-info">
                                            <img src="{{ url("https://www.gravatar.com/avatar/" . md5( strtolower( trim( $comment->user->email ) ) ) ) ."?d=wavatar" }}" class="author-image">
                                            <div class="info">
                                                <h5>{{ $comment->user->name }}</h5>
                                                <p> <small>on {{ date('nS F, Y - g:iA', strtotime($comment->created_at)) }}</small></p>
                                            </div>
                                            <div class="comment">
                                                <p>{{ $comment->comment }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                            @endforeach
                        @else
                            <h3 class="lead text-center mb-5">No Comments</h3>
                        @endif
                    </div>
                </div>
            </div>



            <div class="row">
                <div class="col-md-12">
                    @if (Auth::check())
                        <form method="post" action="{{  route('comments.store', $posts->id) }}" data-parsley-validate="">
                            @csrf
                            <div class="form-group">
                                <label for="comment">Add a comment</label>
                                <textarea class="form-control" id="comment" name="comment" rows="3" placeholder="Write your comment here..." required=""></textarea>
                            </div>

                            <button type="submit" class="btn btn-info">Submit</button>
                        </form>
                    @else
                        <h3 class="lead text-center">Please <a href="/login">Login</a> to add a comment.</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>


@endsection

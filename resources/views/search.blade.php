@extends('layouts.app')



@section('content')
    <div class="octo-content">
		<div class="container">
            @if(isset($posts))
                <h3 class="lead mb-3"> The Search results for your query <strong>"{{ $query }}" </strong> are :</h3>
                @foreach ($posts as $post)
                    <div class="col-md-12">
                        <div class="card flex-md-row mb-4 shadow-sm h-md-250">
                            <div class="thumbnail-holder">
                                <div class="bd-placeholder-img card-img-right flex-auto d-none d-lg-block thumbnail" style="background: url('{{ url(asset('img/blog.jpg')) }}')"></div>
                            </div>
                            <div class="card-body d-flex flex-column align-items-start">
                                <strong class="d-inline-block mb-2 text-primary">{{ $post->category->name }}</strong>
                                <h3 class="mb-0">
                                    <a class="tex-dark" href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                                </h3>
                                <div class="mb-1 text-muted">Written <strong>{{ $post->created_at->diffForHumans() }}</strong> by <strong>{{ $post->user->name }} </strong></div>
                                <p class="card-text mb-auto">{{ substr($post->body, 0, 450) }} {{ strlen($post->body) > 450 ? "..." : ""  }}</p>
                                <a class="text-primary" href="{{ route('blog.show', $post->slug) }}">Continue reading</a>
                            </div>

                        </div>
                    </div>
                @endforeach
            @else
                <h3 class="lead">{{$error}}</h3>
            @endif            
        </div>
    </div>

@endsection

@extends('layouts.app')

@section('title', ' | '. $title)

@section('content')
    <div class="octo-content">
		<div class="container">
            <div class="row">
                @if (count($posts) > 0)
                    @foreach ($posts as $post)
                        <div class="col-md-12">
                            <div class="card flex-md-row mb-4 shadow-sm h-md-250">
                                <div class="thumbnail-holder">
                                    <div class="bd-placeholder-img card-img-right flex-auto d-none d-lg-block thumbnail" style="background: url('{{ url(asset('img/uploads/'.$post->image)) }}')"></div>
                                </div>
                                <div class="card-body d-flex flex-column align-items-start">
                                    <strong class="d-inline-block mb-2 text-primary">{{ $post->category->name }}</strong>
                                    <h3 class="mb-0">
                                        <a class="tex-dark" href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                                    </h3>
                                    <div class="mb-1 text-muted">Written <strong>{{ $post->created_at->diffForHumans() }}</strong> by <strong>{{ $post->user->name }} </strong></div>
                                    <p class="card-text mb-auto">{{ strip_tags(substr($post->body, 0, 450)) }} {{ strlen($post->body) > 450 ? "..." : ""  }}</p>
                                    <a class="text-primary" href="{{ route('blog.show', $post->slug) }}">Continue reading</a>
                                </div>

                            </div>
                        </div>
                    @endforeach

                @else
                    <p>No Posts Found</p>
                @endif
            </div>
            <div class="text-center">
                {{ $posts->currentPage() }} of {{ $posts->lastPage() }} results

                {{ $posts->links() }}
            </div>
        </div>
    </div>


@endsection

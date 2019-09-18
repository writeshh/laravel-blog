@extends('layouts.app')

@section('title', ' | '.$title)

@section('content')
	<!-- main-content -->
	<div class="octo-content">
		<div class="container">
			<div class="row">
				<div class="jumbotron p-5 p-md-5 text-white rounded bg-dark" style="background-image: url('{{ asset('img/uploads/'.$posts[0]->image) }}'); background-repeat: no-repeat; background-size: cover; background-position: center">
					<div class="col-md-6 px-0">
						<h1 class="display-4 font-italic text-light">{{ $posts[0]->title }}</h1>
						<p class="lead my-3">{{ strip_tags(html_entity_decode(substr($posts[0]->body, 0, 250))) }}</p>
						<p class="lead mb-0"><a href="/blog/{{ $posts[0]->slug }}" class="text-white font-weight-bold">Continue reading...</a></p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="octo-scontent">
		<div class="container">
			<div class="row pb-5">
				<div class="col">
					<div class="section_title_container text-center">
						<div class="section_title"><h2>Latest Posts</h2></div>
						<div class="section_subtitle">From The Blog</div>
					</div>
				</div>
			</div>
			<div class="row">
				@foreach ($posts as $post)
					<div class="col-md-4 text-center">
						<div class="card mb-4 shadow-sm">
							@if (isset($post->image))
								<img class="bd-placeholder-img card-img-top" width="100%" height="225" src="{{ asset('img/uploads/'. $post->image) }}" alt="">
							@else
								<svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail"><title>Placeholder</title><rect fill="#55595c" width="100%" height="100%"/><text fill="#eceeef" dy=".3em" x="50%" y="50%">NO IMAGE</text></svg>
							@endif
							<div class="card-body card-grid">
								<h3 class="mb-0 lead">
									<a class="tex-dark" href="/posts/{{ $post->id }}">{{ $post->title }}</a>
								</h3>
								<hr>
								<p class="card-text">{{ strip_tags(html_entity_decode(substr($post->body, 0, 100))) }} {{ strlen($post->body) > 100 ? "..." : ""  }}</p>
								<div class="d-flex justify-content-between align-items-center">
									<small class="text-muted"><span class="lnr lnr-calendar-full"></span> {{ date('d M, Y', strtotime($post->created_at)) }}</small>
									<a class="btn btn-primary" href="/blog/{{ $post->slug }}">Read More</a>
									<small class="text-muted"><span class="lnr lnr-clock"></span> {{ date('h:i A', strtotime($post->created_at)) }}</small>
								</div>
							</div>
						</div>
					</div>
				@endforeach
			</div>
			<div class="row pt-5 justify-content-center">
				<a href="/blog" class="btn btn-primary btn-lg">View All Posts -></a>
			</div>
		</div>
	</div>
	<!-- end-main-content -->

@endsection

@extends('layouts.app')

@section('title', ' | Edit Post '. $posts->title)

@section('content')
    <div class="octo-content">
		<div class="container">
            <div class="row">
                <div class="col-md-8">
                    <form class="" action="{{ route('posts.update', $posts->id) }}" method="post" data-parsley-validate="" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group input-group-lg">
                            <label for="title">Enter Title</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Enter Post Title" value="{{ $posts->title }}" required="" minlength="5" maxlength="100">
                        </div>

                        <div class="form-group">
                            <label for="title">Select Category</label>
                            <select class="form-control" name="category" required="">
                                @foreach ($categories as $key => $value)
                                    <option value="{{$key}}" {{ $key == $posts->category_id ? "selected" : ""}}>{{$value}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="tags">Select Tags</label>
                            <select id="tags" name="tags[]" class="js-example-basic-multiple form-control" multiple="multiple">
                                <option value=""><option>
                                    @foreach ($tags as $key => $value )

                                        <option value="{{ $key }}"
                                        @foreach ($posts->tags as $tag)
                                            {{ $key == $tag->id ? " selected" : ""}}
                                        @endforeach >
                                        {{ $value }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="slug">Enter Slug</label>
                            <input type="text" class="form-control" id="slug" name="slug" placeholder="Enter Post Slug" value="{{ $posts->slug }}" required=""  minlength="5" maxlength="100">
                        </div>

                        <div class="form-group">
                            <label for="group2">Update Featured Image</label>
                            <div class="input-group" id="group2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="addon2"><i class="far fa-file-image"></i></span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="featured_img"  name="featured_img" aria-describedby="addon2">
                                    <label class="custom-file-label" for="image">Choose Photo</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="body">Description</label>
                            <textarea class="form-control" id="body" name="body" rows="3" placeholder="Write your description here..." required="">{{ $posts->body }}</textarea>
                        </div>


                    </div>


                    <div class="col-md-4">
                        <div class="card card-body bg-light shadow p-3 mb-5 bg-white rounded text-center">

                            <div class="row">
                                <div class="col-sm">
                                    Create At:
                                </div>
                                <div class="col-sm">
                                    {{ date('d M Y, h:i A', strtotime($posts->created_at)) }}
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-sm">
                                    Last Upated:
                                </div>
                                <div class="col-sm">
                                    {{ date('d M Y, h:i A', strtotime($posts->updated_at)) }}
                                </div>

                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-6">
                                    <a href="{{ route('posts.show' , $posts->id) }}" class="btn btn-danger btn-block">Cancel</a>
                                </div>

                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-success btn-block">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <script>
        CKEDITOR.replace( 'body' );
    </script>

    <script>
		$("#tags").select2({
			placeholder: "Select tags",
			allowClear: true
		});

		$(document).ready(function(){
			$(".js-example-basic-multiple").select2();
		});//document ready
	</script>

@endsection

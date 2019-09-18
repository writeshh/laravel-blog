@extends('layouts.app')

@section('title', ' | '. $title)

@section('content')
	<div class="octo-content">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<form method="post" action="{{ route('posts.store') }}" data-parsley-validate="" enctype="multipart/form-data">
						@csrf
						<div class="form-group">
							<label for="title">Enter Title</label>
							<input type="text" class="form-control" id="title" name="title" placeholder="Enter Post Title" required="" minlength="5" maxlength="100" pattern="[\w\d\-\_\.\ ]+">
						</div>

						<div class="form-group">
							<label for="body">Description</label>
							<textarea class="form-control" id="body" name="body" rows="3" placeholder="Write your description here..." required=""></textarea>
						</div>

						<div class="form-group">
							<label for="category">Select Category</label>
							<select class="form-control" name="category" required="">
								<option selected disabled value="">Select</option>
								@foreach ($categories as $category )
									<option value="{{ $category->id }}">{{ $category->name }}</option>
								@endforeach
							</select>
						</div>

						<div class="form-group">
							<label for="tags">Select Tags</label>
							<select id="tags" name="tags[]" class="js-example-basic-multiple form-control" multiple="multiple">
								<option value=""><option>
									@foreach ($tags as $tag )
										<option value="{{ $tag->id }}"> {{ $tag->name }} </option>
									@endforeach
								</select>
							</div>

							<div class="form-group">
								<label for="group2">You can also add a picture</label>
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

							<button type="submit" class="btn btn-info">Submit</button>
						</form>
					</div>
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

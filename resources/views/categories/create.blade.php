@extends('layouts.app')

@section('title', ' | '. $title)

@section('content')
	<div class="octo-content">
		<div class="container">
			<div class="row">
				<div class="col-md-12">

					<form method="post" action="{{ route('categories.store') }}" data-parsley-validate="">
						@csrf
						<div class="form-group">
							<label for="name">Enter Name</label>
							<input type="text" class="form-control" id="name" name="name" placeholder="Enter Category Name" required="" minlength="3" maxlength="100" >
						</div>

						<button type="submit" class="btn btn-info">Submit</button>
					</form>
				</div>
			</div>

		</div>
	</div>
@endsection

@extends('layouts.app')

@section('name', ' | Edit Category '. $category->name)

@section('content')
    <div class="octo-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <form class="" action="{{ route('categories.update', $category->id) }}" method="post" data-parsley-validate="">
                        @csrf
                        @method('PUT')
                        <div class="form-group input-group-lg">
                            <label for="name">Enter Category Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Category Name" value="{{ $category->name }}" required="" minlength="5" maxlength="100">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card card-body bg-light shadow p-3 mb-5 bg-white rounded text-center">

                            <div class="row">
                                <div class="col-sm">
                                    Create At:
                                </div>
                                <div class="col-sm">
                                    {{ date('d M Y, h:i A', strtotime($category->created_at)) }}
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-sm">
                                    Last Upated:
                                </div>
                                <div class="col-sm">
                                    {{ date('d M Y, h:i A', strtotime($category->updated_at)) }}
                                </div>

                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-6">
                                    <a href="{{ route('categories.index') }}" class="btn btn-danger btn-block">Cancel</a>
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

@endsection

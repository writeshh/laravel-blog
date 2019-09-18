@extends('layouts.app')

@section('title', ' | '. $title)

@section('content')
    <div class="octo-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Created at</th>
                                <th scope="col">Last Updated</th>
                                <th scope="col">~</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($categories) > 0)
                                @foreach ($categories as $category)
                                    <tr>
                                        <th scope="row">{{ $category->id }}</th>
                                        <td><a class="tex-dark" href="/posts/{{ $category->id }}">{{ $category->name }}</a></td>
                                        <td>{{ date('d M Y', strtotime($category->created_at)) }}</td>
                                        <td>{{ date('d M Y', strtotime($category->updated_at)) }}</td>
                                        <td> <a class="btn btn-warning" href="{{ route('categories.edit' , $category->id) }}">Edit</a> </td>
                                    </tr>
                                @endforeach
                            @else
                                <p>No Posts Found</p>
                            @endif
                        </tbody>
                    </table>

                </div>
                <div class="col-md-4">
                    <div class="card bg-light shadow bg-white rounded">
                        <div class="card-header text-center">
                            <h3 class="lead">Create New Category</h3>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('categories.store') }}" data-parsley-validate="">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Category Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Category Name" required="" minlength="3" maxlength="100" >
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-info">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center">
                {{ $categories->currentPage() }} of {{ $categories->lastPage() }} results

                {{ $categories->links() }}
            </div>

        </div>
    </div>
@endsection

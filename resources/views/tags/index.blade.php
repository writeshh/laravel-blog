@extends('layouts.app')

@section('title', ' | '. $title)

@section('content')
    <div class="octo-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    @if (count($tags) > 0)
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

                                @foreach ($tags as $tag)
                                    <tr>
                                        <th scope="row">{{ $tag->id }}</th>
                                        <td><a class="tex-dark" href="/tags/{{ $tag->id }}">{{ $tag->name }}</a></td>
                                        <td>{{ date('d M Y', strtotime($tag->created_at)) }}</td>
                                        <td>{{ date('d M Y', strtotime($tag->updated_at)) }}</td>
                                        <td> <a class="btn btn-primary" href="{{ route('tags.show', $tag->id) }}">View</a> <a class="btn btn-warning" href="{{ route('tags.edit' , $tag->id) }}">Edit</a> </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    @else
                        <p>No Tags Found.</p>
                    @endif
                </div>
                <div class="col-md-4">
                    <div class="card bg-light shadow bg-white rounded ">
                        <div class="card-header text-center">
                            <h3 class="lead">Create New Tag(s)</h3>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('tags.store') }}" data-parsley-validate="">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Tag name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Tag Name" required="" minlength="3" maxlength="100" >
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
                {{ $tags->currentPage() }} of {{ $tags->lastPage() }} results

                {{ $tags->links() }}
            </div>

        </div>
    </div>
@endsection

@extends('layouts.app')

@section('title', ' | '. $title)

@section('content')
    <div class="octo-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <form action="{{ route('comments.update', $comment->id) }}" method="post" data-parsley-validate="">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="comment">Enter Comment</label>
                            <textarea id="comment" name="comment" class="form-control"  rows="8" placeholder="Enter Comment" required="" minlength="5" maxlength="2000">{{ $comment->comment }}</textarea>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card card-body bg-light shadow p-3 mb-5 bg-white rounded">

                            <div class="row mb-2">
                                <div class="col-sm">
                                    <strong>Create At:</strong>
                                    <p>{{ date('d M Y, h:i A', strtotime($comment->created_at)) }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm">
                                    <strong>Last Upated:</strong>
                                    <p>{{ date('d M Y, h:i A', strtotime($comment->updated_at)) }}</p>
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
                </div>

        </div>
    </div>
    @endsection

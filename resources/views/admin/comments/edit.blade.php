@extends('admin.layouts.app')
@section('title', 'Comments')
@section('content')
    <div class="container shadow card mt-4 p-lg-5">
        <h1 class="text-center text-decoration-underline mb-3 mt-2">Edit Comment</h1>
        <div class="d-flex justify-content-between mb-2">
            <a href="{{ route('admin.comments.index') }}" class="btn btn-primary">All Comments</a>
        </div>
        <form action="{{ route('admin.comments.update', $comment->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="mt-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" id="username" class="form-control" placeholder="Enter comment Name"
                    value="{{ $comment->user->name }}" readonly disabled>
            </div>

            <div class="mt-3">
                <label for="title" class="form-label">Post Title</label>
                <input type="text" name="title" id="title" class="form-control" placeholder="Enter comment Name"
                    value="{{ $comment->commentable->title }}" readonly disabled>
            </div>

            <div class="mt-3">
                <label for="status" class="form-label">Comment Status</label>
                @if ($errors->has('status'))
                    <span class="text-danger">
                        * {{ $errors->first('status') }}
                    </span>
                @endif
                <select name="status" id="status" class="form-control">
                    <option value="" selected disabled> Select Comment Status </option>
                    <option value="draft" @selected($comment->status == 'draft')>draft</option>
                    <option value="published" @selected($comment->status == 'published')>published</option>
                </select>
            </div>

            <div class="mt-3">
                <label for="content" class="form-label"> Comment Content </label>
                @if ($errors->has('content'))
                    <span class="text-danger">
                        * {{ $errors->first('content') }}
                    </span>
                @endif
                <textarea name="content" id="content" cols="30" rows="4" class="form-control"> {{ $comment->content }} </textarea>
            </div>

            <div class="mt-3">
                <input class="btn btn-primary form-control" type="submit" value="Update Comment">
            </div>
        </form>

    </div>
@endsection

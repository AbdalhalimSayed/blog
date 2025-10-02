@extends('layouts.app')
@section('title', 'Comment')
@section('content')
    <div class="container">
        <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
        @error('post')
            <p class="alert alert-warning">{{ $message }}</p>
        @enderror
        <form action="{{ route('mixmind.post.comment.store') }}" method="post">
            @csrf
            <input type="hidden" name="post" value="{{ $post->id }}">
            <div class="mt-4">
                <label for="content" class="form-label">Comment</label>
                @error('content')
                    <span class="mr-5 text-danger">* {{ $message }}</span>
                @enderror
                <input type="text" class="form-control @error('content') is-invalid @enderror" name="content"
                    id="content">
            </div>
            <input type="submit" value="Send Comment" class="btn btn-primary mt-4">
        </form>
    </div>
@endsection

@extends('layouts.app')
@section('title', 'Post')
@section('content')
    <div class="container">
        <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
        <div class="post-card mt-4">
            <h2 class="mb-3">{{ $post->title }}</h2>
            <div class="d-flex gap-4">
                <p class="text-muted">Published on <span class="fw-bold">{{ $post->created_at }}</span></p>
                <p class="text-muted">Author <span class="fw-bold">{{ ucfirst($post->user->name) }}</span></p>
            </div>
            <p class="mb-4">
                {{ $post->content }}
            </p>
        </div>
        <div class="alert alert-secondary">
            <a href="{{ route('mixmind.post.comment', $post->id) }}" class="text-decoration-none text-dark">
                <i class="fa-solid fa-comment"></i>
                Comment
            </a>
        </div>

        @foreach ($comments as $comment)
            <div class="post-card">
                <div class="d-flex justify-content-between">
                    <h4 class="mb-3">{{ $comment->user->name }}</h4>
                    <p class="text-muted">Published on <span class="fw-bold"> {{ $comment->created_at }} </span></p>
                </div>
                <p class="mb-4 text-truncate" style="max-width:100%">
                    {{ $comment->content }}
                </p>
            </div>
        @endforeach
    </div>
@endsection

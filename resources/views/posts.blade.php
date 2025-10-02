@extends('layouts.app')
@section('title', 'Posts')
@section('content')

    <div class="container">
        @foreach ($posts as $post)
            <div class="post-card">
                <h2 class="mb-3">{{ $post->title }}</h2>
                <div class="d-flex gap-4">
                    <p class="text-muted">Published on <span class="fw-bold">{{ $post->created_at }}</span></p>
                    <p class="text-muted">Author <span class="fw-bold">{{ ucfirst($post->user->name) }}</span></p>
                </div>
                <p class="mb-4 text-truncate" style="max-width:100%">
                    {{ $post->content }}
                </p>
                <a href="{{ route('mixmind.post.read', $post->id) }}" class="read-more">Read More</a>
            </div>
        @endforeach
    </div>
@endsection

@extends('layouts.app')
@section('title', 'Posts Category')
@section('content')

    <div class="container py-5">
        <!-- Blog Post Card -->
        {{-- <div class="post-card">
            <h2 class="mb-3">Your Blog Post Title</h2>
            <p class="text-muted">Published on <span class="fw-bold">July 3, 2025</span></p>
            <p class="mb-4 text-truncate" style="max-width:100%">
                This is a short excerpt or sub-content of your blog post.
                Summarize the main idea
                here to
                entice readers to click "Read More". You can add 2-3 lines maxThis is a short excerpt or sub-content of
                your blog post. Summarize the main idea here to
                entice readers to click "Read More". You can add 2-3 lines max.This is a short excerpt or sub-content of
                your blog post. Summarize the main idea here to
                entice readers to click "Read More". You can add 2-3 lines max.
            </p>
            <a href="#" class="read-more">Read More</a>
        </div> --}}
        <div class="mb-5 d-flex justify-content-center gap-4">
            <h1 class="text-decoration-underline">All posts For <span class="text-primary">{{ $category->name }} </span>
                Category
            </h1>


        </div>
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

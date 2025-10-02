@extends('admin.layouts.app')
@section('title', 'Posts')
@section('content')
    <div class="container shadow card mt-4 p-lg-5">
        <h1 class="text-center text-decoration-underline mb-3 mt-2">Edit Post</h1>
        <div class="d-flex justify-content-between mb-2">
            <a href="{{ route('admin.posts.index') }}" class="btn btn-primary">All Posts</a>
        </div>


        <div class="form">
            <form action="{{ route('admin.posts.update', $post->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="mt-3">
                    <label for="title" class="form-label">Post Title</label>
                    @if ($errors->has('title'))
                        <span class="text-danger">
                            * {{ $errors->first('title') }}
                        </span>
                    @endif
                    <input type="text" id="title" name="title" class="form-control"
                        placeholder="Please Enter Title For post." value="{{ $post->title }}">
                </div>



                <div class="mt-3">
                    <label for="content" class="form-label">Post Content</label>
                    @if ($errors->has('content'))
                        <span class="text-danger">
                            * {{ $errors->first('content') }}
                        </span>
                    @endif
                    <textarea name="content" id="content" cols="30" rows="8" placeholder="Enter Post Content"
                        class="form-control">{{ $post->content }}</textarea>
                </div>

                <div class="mt-3">
                    <label for="status" class="form-label">Post Status</label>
                    @if ($errors->has('status'))
                        <span class="text-danger">
                            * {{ $errors->first('status') }}
                        </span>
                    @endif
                    <select name="status" id="status" class="form-control">
                        <option value="" selected disabled> Select Status Of Post </option>
                        <option value="draft" @selected($post->status == 'draft')>draft</option>
                        <option value="published" @selected($post->status == 'published')>published</option>
                        <option value="archive" @selected($post->status == 'archive')>archive</option>
                    </select>
                </div>

                <div class="mt-3">
                    <label for="user" class="form-label">Post's User</label>
                    @if ($errors->has('user_id'))
                        <span class="text-danger">
                            * {{ $errors->first('user_id') }}
                        </span>
                    @endif
                    <select name="user_id" id="user" class="form-control">
                        <option value="" selected disabled>Select User </option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" @selected($user->id == $post->user_id)> {{ $user->name }}
                            </option>
                        @endforeach

                    </select>
                </div>

                <div class="mt-3">
                    <label for="cat" class="form-label">Post's Category</label>
                    @if ($errors->has('category_id'))
                        <span class="text-danger">
                            * {{ $errors->first('category_id') }}
                        </span>
                    @endif
                    <select name="category_id" id="cat" class="form-control">
                        <option value="" selected disabled>Select Category </option>

                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected($category->id == $post->category_id)>
                                {{ $category->name }} </option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-3">
                    <input type="submit" class="btn btn-primary w-100" value="Update Post ">
                </div>
            </form>
        </div>
    </div>
@endsection

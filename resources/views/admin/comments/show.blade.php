@extends('admin.layouts.app')
@section('title', 'Comments')
@section('content')
    <div class="container shadow card mt-4 p-lg-5">
        <h1 class="text-center text-decoration-underline mb-3 mt-2">Show Comment</h1>
        <div class="d-flex justify-content-between mb-2">
            <a href="{{ route('admin.comments.index') }}" class="btn btn-primary">All Comments</a>
        </div>
        <div class="card">
            <div class="card-header">
                Information About Comment
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <span class="text-success">Author: </span> {{ $comment->user->name }}
                    </div>
                    <div>
                        <span class="text-success">Status: </span> {{ $comment->status }}
                    </div>
                    <div>
                        <span class="text-success">Created_at: </span> {{ $comment->created_at }}
                    </div>
                </div>
                <hr>
                <h5>
                    <span class="text-primary">Post Title: </span>
                    {{ $comment->commentable->title }}
                </h5>
                <p class="card-text">
                    {{ $comment->content }}
                </p>
                <a href="{{ route('admin.comments.edit', $comment->id) }}" class="btn btn-sm btn-warning">Update</a>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                    data-bs-target="#exampleModal{{ $comment->id }}">
                    Delete
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal{{ $comment->id }}" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Confirm Delete</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are You Sure Delete comment?
                                <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">No,I'm
                                    Not</button>
                                <input type="submit" class="btn btn-danger btn-sm" value="Yes,I'm ">
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

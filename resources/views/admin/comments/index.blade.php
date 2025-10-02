@extends('admin.layouts.app')
@section('title', 'Comments')
@section('content')
    <div class="container shadow card mt-4 p-lg-5">
        <h1 class="text-center text-decoration-underline mb-3 mt-2">Comments Management</h1>
        {{-- <div class="d-flex justify-content-between mb-2">
        <a href="{{route("admin.comments.create")}}" class="btn btn-primary">Create Comment</a>
    </div> --}}
        <div class="table-responsive">



            <table class="table table-hover table-striped w-100" style="min-width: 1000px;">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">User name</th>
                        <th scope="col">Post Title</th>
                        <th scope="col">Content</th>
                        <th scope="col">Created_at</th>
                        <th scope="col">Status</th>
                        <th scope="col">Comments Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($comments as $comment)
                        <tr>
                            <th scope="row">{{ $comment->id }}</th>
                            <td>{{ $comment->user->name }}</td>
                            <td class="text-truncate" style="max-width: 100px;">{{ $comment->commentable->title }}
                            </td>
                            <td class="text-truncate" style="max-width: 200px;">{{ $comment->content }}</td>
                            <td>{{ $comment->created_at }}</td>
                            <td>
                                @if ($comment->status == 'published')
                                    <a href="{{ route('admin.comments.published', $comment->id) }}"
                                        class="btn btn-success btn-sm">
                                        Published
                                    </a>
                                @else
                                    <a href="{{ route('admin.comments.draft', $comment->id) }}"
                                        class="btn btn-secondary btn-sm">
                                        Draft
                                    </a>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.comments.show', $comment->id) }}"
                                    class="btn btn-sm btn-primary">Show</a>
                                <a href="{{ route('admin.comments.edit', $comment->id) }}"
                                    class="btn btn-sm btn-warning">Update</a>
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
                                                <form action="{{ route('admin.comments.destroy', $comment->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary btn-sm"
                                                    data-bs-dismiss="modal">No,I'm Not</button>
                                                <input type="submit" class="btn btn-danger btn-sm" value="Yes,I'm ">
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>

            <nav aria-label="Page navigation example">
                <div class="d-flex justify-content-between  p-2">
                    <div>
                        Total Page {{ $comments->lastPage() }} Current Page {{ $comments->currentPage() }}
                    </div>
                    <div>
                        <ul class="pagination">
                            @if ($comments->onFirstPage())
                                <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                            @else
                                <li class="page-item "><a class="page-link"
                                        href="{{ $comments->previousPageUrl() }}">Previous</a></li>
                            @endif


                            @if ($comments->hasMorePages())
                                <li class="page-item "><a class="page-link" href="{{ $comments->nextPageUrl() }}">Next</a>
                                </li>
                            @else
                                <li class="page-item disabled"><a class="page-link" href="#">Next</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </nav>

        </div>
    </div>
@endsection

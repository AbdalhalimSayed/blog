@extends('admin.layouts.app')
@section('title', 'Posts')
@section('content')
    <div class="container shadow card mt-4 p-lg-5">
        <h1 class="text-center text-decoration-underline mb-3 mt-2">Posts Management</h1>
        <div class="d-flex justify-content-between mb-2">
            <div>
                <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">Create Posts</a>
                <a href="{{ route('admin.posts.index') }}" class="btn btn-primary">Published Posts</a>
                <a href="{{ route('admin.posts.draft') }}" class="btn btn-primary">Draft Posts</a>
                <a href="{{ route('admin.posts.archive') }}" class="btn btn-primary">Archive Posts</a>

            </div>
            {{-- <a href="{{route("admin.posts.delete")}}" class="btn btn-primary">Deleted Posts</a> --}}
        </div>


        <table class="table table-hover table-responsive  table-striped w-100" style="min-width: 1000px;">
            <thead class="table-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Post Title</th>
                    <th scope="col">Post Content</th>
                    <th scope="col">Post's Author</th>
                    <th scope="col">Post's Category</th>
                    <th scope="col">Post Status</th>
                    <th scope="col">Post Date</th>
                    <th scope="col">Post Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <th scope="row"> {{ $post->id }} </th>
                        <td class="text-truncate" style="max-width: 150px;"> {{ $post->title }} </td>
                        <td class="text-truncate" style="max-width: 200px;"> {{ $post->content }} </td>
                        <td> {{ $post->user->name }} </td>
                        <td> {{ $post->category->name }} </td>
                        <td> {{ $post->status }} </td>
                        <td> {{ $post->created_at }} </td>
                        <td>
                            <a href=" {{ route('admin.posts.show', $post->id) }} " class="btn btn-sm btn-primary">Show</a>
                            <a href=" {{ route('admin.posts.edit', $post->id) }} "
                                class="btn btn-sm btn-warning">Update</a>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#exampleModal{{ $post->id }}">
                                Delete
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{ $post->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Confirm Delete</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Are You Sure Delete Post?
                                            <form action=" {{ route('admin.posts.destroy', $post->id) }} " method="post">
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
                    Total Page {{ $posts->lastPage() }} Current Page {{ $posts->currentPage() }}
                </div>
                <div>
                    <ul class="pagination">
                        @if ($posts->onFirstPage())
                            <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                        @else
                            <li class="page-item "><a class="page-link" href="{{ $posts->previousPageUrl() }}">Previous</a>
                            </li>
                        @endif


                        @if ($posts->hasMorePages())
                            <li class="page-item "><a class="page-link" href="{{ $posts->nextPageUrl() }}">Next</a></li>
                        @else
                            <li class="page-item disabled"><a class="page-link" href="#">Next</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

    </div>
@endsection

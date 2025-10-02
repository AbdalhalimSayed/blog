@extends('admin.layouts.app')
@section('title', 'Categories')
@section('content')
    <div class="container shadow card mt-4 p-lg-5">
        <h1 class="text-center text-decoration-underline mb-3 mt-2">Show Category</h1>
        <div class="d-flex justify-content-between mb-2">
            <a href="{{ route('admin.categories.index') }}" class="btn btn-primary">All Category</a>
        </div>
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <span>
                    {{ $category->name }}
                </span>
                <span>
                    {{ $category->created_at }}
                </span>
            </div>
            <div class="card-body">
                <h5 class="card-title">
                    @if ($category->type == 0)
                        Super Category
                    @else
                        Sub Category
                    @endif
                </h5>
                <p class="card-text">{{ $category->description }}</p>
                <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-warning btn-sm">Update</a>
                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                    data-bs-target="#exampleModal{{ $category->id }}">
                    Delete
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal{{ $category->id }}" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Confirm Delete</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are You Sure Delete Category?
                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="post">
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

        {{-- All Posts For Categories --}}

        @if ($category->type != 0)
            <table class="table table-hover table-responsive mt-4 table-striped w-100" style="min-width: 1000px;">
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
                    @foreach ($category->posts as $post)
                        <tr>
                            <th scope="row"> {{ $post->id }} </th>
                            <td class="text-truncate" style="max-width: 150px;"> {{ $post->title }} </td>
                            <td class="text-truncate" style="max-width: 200px;"> {{ $post->content }} </td>
                            <td> {{ $post->user->name }} </td>
                            <td> {{ $post->category->name }} </td>
                            <td> {{ $post->status }} </td>
                            <td> {{ $post->created_at }} </td>
                            <td>
                                <a href=" {{ route('admin.posts.show', $post->id) }} "
                                    class="btn btn-sm btn-primary">Show</a>
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
                                                <form action=" {{ route('admin.posts.destroy', $post->id) }} "
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
        @endif
    </div>
@endsection

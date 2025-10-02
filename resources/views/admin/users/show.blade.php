@extends('admin.layouts.app')
@section('title', 'Users')

@section('content')
    <div class="container shadow card mt-4 p-lg-5">
        <h1 class="text-center text-decoration-underline mb-3 mt-2">Show User</h1>
        <div class="d-flex justify-content-between mb-2">
            <a href="{{ route('admin.users.index') }}" class="btn btn-primary">All Users</a>
        </div>
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>
                    <img src="{{ Storage::url($user->photo) }}" alt="user-image"
                        style="width: 160px; height: 160px; border-radius: 50%;">
                    {{ $user->name }}
                </span>
                <span>
                    {{ $user->created_at }}
                </span>
            </div>
            <div class="card-body">
                <h5 class="card-title">
                    {{ $user->role }}
                </h5>
                <p class="card-text">{{ $user->email }}</p>
                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning btn-sm">Update</a>
                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                    data-bs-target="#exampleModal{{ $user->id }}">
                    Delete
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal{{ $user->id }}" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Confirm Delete</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are You Sure Delete user?
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="post">
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
        {{--
            All Comments For Users
        --}}
        <div class="table-responsive">

            <h2 class="text-center p-2">All Comments For User <span class="text-primary">{{ $user->name }}</span> </h2>

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
                    @foreach ($user->comments as $comment)
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


        </div>

        {{--
            All Posts For Posts
        --}}
        <h2 class="text-center p-2">All Posts For User <span class="text-primary">{{ $user->name }}</span> </h2>

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
                @foreach ($user->posts as $post)
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
    </div>
@endsection

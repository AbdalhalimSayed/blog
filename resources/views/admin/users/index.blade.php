@extends('admin.layouts.app')
@section('title', 'Users')

@section('content')
    <div class="container shadow card mt-4 p-lg-5">
        <h1 class="text-center text-decoration-underline mb-3 mt-2">Users Management</h1>
        <div class="d-flex justify-content-between mb-2  mt-2">

            <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Create User</a>

            <form action="{{ route('admin.users.search') }}" method="GET" class="w-50">
                <div class="input-group">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search By Name Or Email"
                            aria-label="Recipient's username" name="search" aria-describedby="button-addon2">
                        <input type="submit" class="btn btn-primary" id="button-addon2" value="Search">
                    </div>
                </div>
            </form>

        </div>
        <div class="table-responsive">



            <table class="table table-hover table-striped w-100" style="min-width: 1000px;">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">User name</th>
                        <th scope="col">User email</th>
                        <th scope="col">User Date</th>
                        <th scope="col">User Role</th>
                        <th scope="col">User Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <th scope="row">{{ $user->id }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td>{{ $user->role }}</td>
                            <td>
                                <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-sm btn-primary">Show</a>
                                <a href="{{ route('admin.users.edit', $user->id) }}"
                                    class="btn btn-sm btn-warning">Update</a>
                                <!-- Button trigger modal -->
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
                                                Are You Sure Delete User?
                                                <form action="{{ route('admin.users.destroy', $user->id) }}"
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
                        Total Page {{ $users->lastPage() }} Current Page {{ $users->currentPage() }}
                    </div>
                    <div>
                        <ul class="pagination">
                            @if ($users->onFirstPage())
                                <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                            @else
                                <li class="page-item "><a class="page-link"
                                        href="{{ $users->previousPageUrl() }}">Previous</a></li>
                            @endif


                            @if ($users->hasMorePages())
                                <li class="page-item "><a class="page-link" href="{{ $users->nextPageUrl() }}">Next</a>
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

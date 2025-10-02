@extends('admin.layouts.app')
@section('title', 'Users')

@section('content')
    <div class="container shadow card mt-4 p-lg-5">
        <h1 class="text-center text-decoration-underline mb-3 mt-2">Edit User</h1>
        <div class="d-flex justify-content-between mb-2">
            <a href="{{ route('admin.users.index') }}" class="btn btn-primary">All Users</a>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Edit User</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.users.update', $user->id) }}" method="POST"
                            enctype="multipart/form-data">
                            <!-- Username Field -->
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                @error('name')
                                    <span class="text-danger"> * {{ $message }} </span>
                                @enderror
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="username" name="name" value="{{ $user->name }}" placeholder="Enter username"
                                    required>
                            </div>
                            <!-- Photo Field -->
                            <div class="mb-3">

                                <label for="formFile" class="form-label">User Image</label>
                                @error('photo')
                                    <span class="text-danger"> * {{ $message }} </span>
                                @enderror
                                <input class="form-control" type="file" name="photo" id="formFile">
                            </div>
                            <!-- Email Field -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                @error('email')
                                    <span class="text-danger"> * {{ $message }} </span>
                                @enderror
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ $user->email }}" placeholder="Enter email"
                                    required>
                            </div>



                            <!-- Role Selection -->
                            <div class="mb-3">
                                <label for="role" class="form-label">Role</label>
                                @error('role')
                                    <span class="text-danger"> * {{ $message }} </span>
                                @enderror
                                <select class="form-select @error('role') is-invalid @enderror" id="role"
                                    name="role" required>
                                    <option value="user" @selected($user->role == 'user')>User</option>
                                    <option value="author" @selected($user->role == 'author')>Author</option>
                                    <option value="admin" @selected($user->role == 'admin')>Admin</option>
                                </select>
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid gap-2">
                                <input type="submit" class="btn btn-primary" value="Update User">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

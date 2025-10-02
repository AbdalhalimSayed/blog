@extends('admin.layouts.app')
@section('title', 'Categories')

@section('content')
    <div class="container shadow card mt-4 p-lg-5">
        <h1 class="text-center text-decoration-underline mb-3 mt-2">Category Management</h1>
        <div class="d-flex justify-content-between mb-2">
            <a href="{{ route('admin.categories.index') }}" class="btn btn-primary">All Category</a>

            <form action="{{ route('admin.categories.search') }}" method="GET" class="w-50">
                <div class="input-group">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search By Category Name "
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
                        <th scope="col">Category name</th>
                        <th scope="col">Category Description</th>
                        <th scope="col">Category Date</th>
                        <th scope="col">Category Type</th>
                        <th scope="col">Category Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <th scope="row">{{ $category->id }}</th>
                            <td class="text-truncate" style="max-width: 100px;">{{ $category->name }}</td>
                            <td class="text-truncate" style="max-width: 200px;">{{ $category->description }}</td>
                            <td>{{ $category->created_at }}</td>
                            <td>{{ $category->type == 0 ? 'Super Category' : 'Sub Category' }}</td>
                            <td>
                                <a href="{{ route('admin.categories.show', $category->id) }}"
                                    class="btn btn-sm btn-primary">Show</a>
                                <a href="{{ route('admin.categories.edit', $category->id) }}"
                                    class="btn btn-sm btn-warning">Update</a>
                                <!-- Button trigger modal -->
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
                                                <form action="{{ route('admin.categories.destroy', $category->id) }}"
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
            {{ $categories->links() }}

        </div>
    </div>
@endsection

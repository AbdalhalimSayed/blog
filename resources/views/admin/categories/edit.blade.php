@extends('admin.layouts.app')
@section('title', 'Categories')

@section('content')
    <div class="container shadow card mt-4 p-lg-5">
        <h1 class="text-center text-decoration-underline mb-3 mt-2">Edit Category</h1>
        <div class="d-flex justify-content-between mb-2">
            <a href="{{ route('admin.categories.index') }}" class="btn btn-primary">All Category</a>
        </div>


        <form action="{{ route('admin.categories.update', $category->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="mt-3">
                <label for="catName" class="form-label">Category Name</label>

                @if ($errors->has('name'))
                    <span class="text-danger">
                        * {{ $errors->first('name') }}
                    </span>
                @endif

                <input type="text" name="name" id="catName" class="form-control" placeholder="Enter Category Name"
                    value="{{ $category->name }}">
            </div>

            <div class="mt-3">
                <label for="catDes" class="form-label">Category Description</label>
                @if ($errors->has('description'))
                    <span class="text-danger">
                        * {{ $errors->first('description') }}
                    </span>
                @endif
                <textarea class="form-control" name="description" id="catDes" cols="30" rows="5"
                    placeholder="Enter Category Description">{{ $category->description }}</textarea>
            </div>

            <div class="mt-3">
                <label for="catSection" class="form-label">Category Section</label>
                @if ($errors->has('type'))
                    <span class="text-danger">
                        * {{ $errors->first('type') }}
                    </span>
                @endif
                <select name="type" id="catSection" class="form-control">
                    <option value="0">Super Category</option>
                    @foreach ($superCategory as $superCat)
                        <option value="{{ $superCat->id }}" @selected($category->type == $superCat->id)> {{ $superCat->name }}
                        </option>
                    @endforeach

                </select>
            </div>
            <div class="mt-3">
                <input class="btn btn-primary form-control" type="submit" value="Update Category">
            </div>
        </form>
    </div>
@endsection

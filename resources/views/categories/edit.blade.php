@extends('layouts.master')
@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="text-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card mt-4">
            <div class="card-header">
                Edit Category
            </div>
            <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <input type="text" value="{{ $category->name }}" name="name" placeholder="Enter Category Name"
                        id="" class="form-control card-body" />
                </div>
                <div class="card-body">
                    <img src="{{ asset('categoryImages/' . $category->image) }}" alt="{{ $category->image }}"
                        style="width: 50px; height:50px;">
                    <input type="file" name="image" class="form-control mt-2">
                </div>
                <div class="form-check form-switch form-control">
                    <label for="" class="form-check-label">
                        Active or Inactive
                    </label>
                    <input type="checkbox" name="status" id="" class="form-check-input" role="switch"
                        {{ $category->status ? 'checked' : '' }}>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back</a>
                </div>
            </form>
        </div>
    </div>
@endsection

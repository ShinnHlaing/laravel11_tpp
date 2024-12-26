@extends('layouts.master')
@endsection
<div class="container">
{{-- error check --}}
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
        Create New Product
    </div>
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" name="name" placeholder="Enter Product Name" id=""
            class="form-control card-body" />
        <input type="text" name="description" placeholder="Enter Product Description" id=""
            class="form-control card-body" />
        <input type="text" name="price" placeholder="Enter Price" id=""
            class="form-control card-body" />
        <input type="file" name="image" class="form-control card-body" />
        <select name="category_id" class="form-select" id="">
            @foreach ($categories as $category)
                <option name="category_id" value="{{ $category->id }}">{{ $category->name }}
                </option>
            @endforeach
        </select>
        <div class="card-body">
            <div class="form-check form-switch">
                <label for="" class="form-check-label">
                    Success or Pending
                </label>
                <input type="checkbox" name="status" id="" class="form-check-input" role="switch"
                    checked>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Create</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </form>
</div>
</div>
@endsection

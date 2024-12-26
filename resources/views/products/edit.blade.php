@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="card mt-4">
            @if ($errors->any())
                <div class="text-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card-header">
                Edit Products
            </div>
            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <input type="text" value="{{ $product->name }}" name="name" placeholder="Enter Product Name"
                        id="" class="form-control card-body" />
                    <input type="text" value="{{ $product->description }}" name="description"
                        placeholder="Enter Product Description" id="" class="form-control card-body" />
                    <input type="text" value="{{ $product->price }}" name="price" placeholder="Enter Price"
                        id="" class="form-control card-body" />
                    <div class="card-body">
                        <img src="{{ asset('productImages/' . $product->image) }}" alt="{{ $product->image }}"
                            style="width: 50px; height:50px;">
                        <input type="file" name="image" class="form-control mt-2">
                    </div>
                    <select name="category_id" class="form-select mb-3" id="">
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                            <option name="category_id" value="{{ $category->id }}">{{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    <div class="form-check form-switch form-control">
                        <label for="" class="form-check-label">
                            Success or Pending
                        </label>
                        <input type="checkbox" name="status" id="" class="form-check-input" role="switch"
                            {{ $product->status ? 'checked' : '' }}>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back</a>
                </div>
            </form>
        </div>
    </div>
@endsection

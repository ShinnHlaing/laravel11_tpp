@extends('layouts.master')
@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="container">
        <a href="{{ route('products.create') }}" class="btn btn-outline-success mb-4 ">Create</a>
        <div class="row">
            @foreach ($products as $item)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('productImages/' . $item->image) }}" class="card-img-middle"
                            alt="{{ $item->image }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->name }}</h5>
                            <p class="card-text">{{ $item->description }}</p>
                            <p class="card-text"><strong>Price:</strong> {{ $item->price }}</p>
                            <p class="card-text"><strong>Category:</strong> {{ $item['category']['name'] }}</p>
                            <p class="card-text"><strong>Status:</strong> {{ $item->status ? 'Success' : 'Pending' }}
                            </p>
                            <a href="{{ route('products.edit', $item->id) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('products.delete', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

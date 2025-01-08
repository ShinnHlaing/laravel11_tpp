@extends('layouts.master')
@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @can('categoryCreate')
            <a href="{{ route('categories.create') }}" class="btn btn-outline-success mb-4">Create</a>
        @endcan
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th class="bg-primary text-white">ID</th>
                    <th class="bg-primary text-white">Name</th>
                    <th class="bg-primary text-white">Image</th>
                    <th class="bg-primary text-white">Status</th>
                    <th class="bg-primary text-white">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td><img src="{{ asset('categoryImages/' . $category->image) }}" alt="{{ $category->image }}"
                                style="width: 50px; height:50px;"></td>
                        <td>{{ $category->status ? 'Active' : 'Inactive' }}</td>
                        <td class="d-flex">
                            @can('categoryEdit')
                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary mb-3">Edit</a>
                            @endcan
                            @can('categoryDelete')
                                <form action="{{ route('categories.delete', $category->id) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-outline-danger">Delete</button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@extends('layouts.master')
@section('content')
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
                Create Category
            </div>
            <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="text" name="name" placeholder="Enter Category Name" id=""
                    class="form-control card-body" />
                <input type="file" name="image" class="form-control card-body" />
                <div class="card-body">
                    <div class="form-check form-switch">
                        <label for="" class="form-check-label">
                            Active or inactive
                        </label>
                        <input type="checkbox" name="status" id="" class="form-check-input" role="switch"
                            checked>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Create</button>
                    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back</a>
                </div>
            </form>
        </div>
    </div>
@endsection

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
                Edit Permission
            </div>
            <form action="{{ route('permissions.update', $permission->id) }}" method="POST">
                @csrf
                <div class="card-body">
                    <input type="text" value="{{ $permission->name }}" name="name" placeholder="Enter User Name"
                        id="" class="form-control card-body" />
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('permissions.index') }}" class="btn btn-secondary">Back</a>
                </div>
            </form>
        </div>
    </div>
@endsection

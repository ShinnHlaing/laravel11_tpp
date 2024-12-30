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
                Create Permission
            </div>
            <form action="{{ route('permissions.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" placeholder="Enter Name" required />
                    </div>
                </div>
                <div class="card-footer"><button type="submit" class="btn btn-primary">Create</button></div>
            </form>
        </div>
    </div>
@endsection

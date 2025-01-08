@extends('layouts.master')
@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('permissions.create') }}" class="btn btn-outline-success mb-4">Create</a>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th class="bg-primary text-white">No</th>
                    <th class="bg-primary text-white">Name</th>
                    <th class="bg-primary text-white">Role</th>
                    <th class="bg-primary text-white">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($permissions as $permission)
                    <tr>
                        <td>{{ $permission->id }}</td>
                        <td>{{ $permission->name }}</td>
                        <td>
                            @foreach ($permission->roles as $role)
                                <span class="badge badge-primary">{{ $role->name }}</span>
                            @endforeach
                        </td>

                        <td>
                            <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-primary mb-3">Edit</a>
                            <form action="{{ route('permissions.delete', $permission->id) }}" method="POST">
                                @csrf
                                <button class="btn btn-outline-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

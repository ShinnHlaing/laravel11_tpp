@extends('layouts.master')
@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('users.create') }}" class="btn btn-outline-success mb-4">Create</a>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th class="bg-primary text-white">No</th>
                    <th class="bg-primary text-white">Name</th>
                    <th class="bg-primary text-white">Email</th>
                    <th class="bg-primary text-white">Role</th>
                    <th class="bg-primary text-white">Profile</th>
                    <th class="bg-primary text-white">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @foreach ($user->roles as $role)
                                <span class="badge badge-primary">{{ $role->name }}</span>
                            @endforeach
                        </td>
                        <td>
                            <img src="{{ asset('userImages/' . $user->image) }}" alt="{{ $user->image }}"
                                style="width: 50px; height:50px;">
                        <td>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary mb-3">Edit</a>
                            <form action="{{ route('users.delete', $user->id) }}" method="POST">
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

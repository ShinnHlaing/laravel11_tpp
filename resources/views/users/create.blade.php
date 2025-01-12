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
                Create User
            </div>
            <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" placeholder="Enter Name" required />
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="Enter Email" required />
                    </div>
                    <div class="form-group">
                        <select name="status" id="status" class="form-select">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <div class="form-group">
                        @foreach ($roles as $role)
                            <div>
                                <input type="checkbox" class="input-check-label" name="roles[]"
                                    id="role_{{ $role->id }}" value="{{ $role->id }}">
                                <label for="role_{{ $role->id }}" class="form-check-label">{{ $role->name }}</label>
                            </div>
                        @endforeach
                    </div>
                    <div class="form-group">
                        <input type="file" name="image" class="form-control" />
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Enter Password" required />
                    </div>
                    <div class="form-group">
                        <input type="password" name="password_confirmation" class="form-control"
                            placeholder="Confirm Password" required />
                    </div>
                </div>
                <div class="card-footer"><button type="submit" class="btn btn-primary">Create</button></div>
            </form>
        </div>
    </div>
@endsection

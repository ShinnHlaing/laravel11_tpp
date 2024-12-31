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
                Create Role
            </div>
            <form action="{{ route('roles.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" placeholder="Enter Name" required />
                    </div>
                    <div class="form-group">
                        <label for="permissions">Assign Permissions</label>
                        <div class="form-check">
                            @foreach ($permissions as $permission)
                                <div>
                                    <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                        id="permission_{{ $permission->id }}" class="form-check-input">
                                    <label for="permission_{{ $permission->id }}"
                                        class="form-check-label">{{ $permission->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="card-footer"><button type="submit" class="btn btn-primary">Create</button></div>
            </form>
        </div>
    </div>
@endsection

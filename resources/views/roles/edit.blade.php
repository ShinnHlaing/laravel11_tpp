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
                Edit Role
            </div>
            <form action="{{ route('roles.update', $role->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Role Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $role->name }}" required />
                </div>
                <div class="form-group">
                    <label for="permissions">Assign Permissions</label>
                    <div class="form-check">
                        @foreach ($permissions as $permission)
                            <div>
                                <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                    id="permission_{{ $permission->id }}" class="form-check-input"
                                    {{ in_array($permission->id, $role->permissions->pluck('id')->toArray()) ? 'checked' : '' }}>
                                <label for="permission_{{ $permission->id }}"
                                    class="form-check-label">{{ $permission->name }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('roles.index') }}" class="btn btn-secondary">Back</a>
                </div>
            </form>
        </div>
    </div>
@endsection

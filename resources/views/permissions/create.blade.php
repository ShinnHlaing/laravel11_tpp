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
                        <div class="form-group">
                            <label for="permissions">Assign Roles</label>
                            <div class="form-check">
                                @foreach ($roles as $role)
                                    <div>
                                        <input type="checkbox" name="roles[]" value="{{ $role->id }}"
                                            id="permission_{{ $role->id }}" class="form-check-input">
                                        <label for="permission_{{ $role->id }}"
                                            class="form-check-label">{{ $role->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer"><button type="submit" class="btn btn-primary">Create</button></div>
            </form>
        </div>
    </div>
@endsection

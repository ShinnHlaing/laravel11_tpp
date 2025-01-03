@extends('layouts.master')
@section('content')
    <div class="container">
        {{-- {{ dd($roles) }} --}}
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
                Edit User
            </div>
            <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <input type="text" value="{{ $user->name }}" name="name" placeholder="Enter User Name"
                        id="" class="form-control card-body" />
                    <input type="text" value="{{ $user->email }}" name="email" placeholder="Enter User Email"
                        id="" class="form-control card-body" />
                    <div class="card-body">
                        <select name="status" id="" class="form-select">
                            <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ $user->status == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                    <div class="card-body">
                        <select name="roles[]" id="" class="form-select">
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}"
                                    {{ $user->roles->contains($role->id) ? 'selected' : '' }}>
                                    {{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="cardbody mb-3">
                        <img src="{{ asset('userImages/' . $user->image) }}" alt="{{ $user->image }}"
                            style="width: 50px; height:50px;">
                        <input type="file" name="image" class="form-control mt-2">
                    </div>
                    <input type="password" name="password" placeholder="Enter Password" />
                    <input type="password" name="password_confirmation" placeholder="Confirm Password" />
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">Back</a>
                </div>
            </form>
        </div>
    </div>
@endsection

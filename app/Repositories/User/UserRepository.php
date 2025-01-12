<?php

namespace App\Repositories\User;

use App\Models\Role;
use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function index()
    {
        return User::with('roles')->get();
    }
    public function store($validatedData)
    {
        return User::create($validatedData);
    }

    public function show($id)
    {
        return User::find($id);
    }
}

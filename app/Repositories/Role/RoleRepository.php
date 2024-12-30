<?php

namespace App\Repositories\Role;

use App\Models\Role;
use App\Repositories\Role\RoleRepositoryInterface;

class RoleRepository implements RoleRepositoryInterface
{
    public function index()
    {
        return Role::get();
    }
    public function store($validatedData)
    {
        return Role::create($validatedData);
    }
    public function update($validatedData, $id)
    {
        $role = Role::find($id);
        return $role->update($validatedData);
    }
    public function show($id)
    {
        return Role::find($id);
    }
}

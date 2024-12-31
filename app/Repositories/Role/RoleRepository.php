<?php

namespace App\Repositories\Role;

use App\Models\Role;
use App\Repositories\Role\RoleRepositoryInterface;

class RoleRepository implements RoleRepositoryInterface
{
    public function index()
    {
        return Role::with('permissions')->get();
    }
    public function store($validatedData)
    {
        $role = Role::create($validatedData);
        if (isset($validatedData['permissions'])) {
            $role->permissions()->sync($validatedData['permissions']);
        }
        return $role;
    }
    public function update($validatedData, $id)
    {
        $role = Role::find($id);
        $role->update($validatedData);
        if (isset($validatedData['permissions'])) {
            $role->permissions()->sync($validatedData['permissions']);
        }
        return $role;
    }
    public function show($id)
    {
        return Role::with('permissions')->find($id);
    }
}

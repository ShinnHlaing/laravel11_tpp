<?php

namespace App\Repositories\Role;


use App\Repositories\Role\RoleRepositoryInterface;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleRepository implements RoleRepositoryInterface
{
    public function index()
    {
        return Role::get();
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
        $role = Role::where('id', $id)->first();
        $role->update($validatedData);
        if (isset($validatedData['permissions'])) {
            $role->permissions()->sync($validatedData['permissions']);
        }
        return $role;
    }
    public function show($id)
    {
        return Role::with('permissions')->where('id', $id)->first();
    }
    public function destory($id)
    {
        $role = Role::where('id', $id)->first();
        return $role->delete();
    }
}

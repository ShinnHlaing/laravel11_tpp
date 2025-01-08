<?php

namespace App\Repositories\Permission;

use App\Repositories\Permission\PermissionRepositoryInterface;
use Spatie\Permission\Models\Permission;

class PermissionRepository implements PermissionRepositoryInterface
{
    public function index()
    {
        return Permission::get();
    }
    public function store($validatedData)
    {
        $permission = Permission::create($validatedData);
        if (isset($validatedData['roles'])) {
            $permission->roles()->sync($validatedData['roles']);
        }
        return $permission;
    }
    public function update($validatedData, $id)
    {
        $permission = Permission::where('id', $id)->first();
        $permission->update($validatedData);
        if (isset($validatedData['roles'])) {
            $permission->roles()->sync($validatedData['roles']);
        }
    }
    public function show($id)
    {
        return Permission::with('roles')->where('id', $id)->first();
    }
    public function destory($id)
    {
        $permission = Permission::where('id', $id)->first();
        return $permission->delete();
    }
}

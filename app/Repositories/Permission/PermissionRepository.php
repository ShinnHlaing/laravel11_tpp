<?php

namespace App\Repositories\Permission;

use App\Repositories\Permission\PermissionRepositoryInterface;
use App\Models\Permission;

class PermissionRepository implements PermissionRepositoryInterface
{
    public function index()
    {
        return Permission::get();
    }
    public function store($validatedData)
    {
        return Permission::create($validatedData);
    }
    public function update($validatedData, $id)
    {
        $permission = Permission::find($id);
        return $permission->update($validatedData);
    }
    public function show($id)
    {
        return Permission::find($id);
    }
}

<?php

namespace App\Repositories\Permission;

interface PermissionRepositoryInterface
{
    public function index();
    public function store($validatedData);
    public function update($validatedData, $id);
    public function show($id);
}

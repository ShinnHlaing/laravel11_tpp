<?php

namespace App\Repositories\Role;

interface RoleRepositoryInterface
{
    public function index();
    public function store($validatedData);
    public function update($validatedData, $id);
    public function show($id);
}

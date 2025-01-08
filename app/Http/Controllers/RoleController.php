<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Permission;
use App\Repositories\Role\RoleRepositoryInterface;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    protected $roleRepository;
    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }
    public function index()
    {
        $roles = $this->roleRepository->index();
        return view('roles.index', compact('roles'));
    }
    public function create()
    {
        $permissions = Permission::get();
        return view('roles.create', compact('permissions'));
    }
    public function edit($id)
    {
        $role = $this->roleRepository->show($id);
        $permissions = Permission::all();
        $rolePermissions = $role->permissions->pluck('id')->toArray();
        return view('roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        $this->roleRepository->store($validatedData);
        return redirect()->route('roles.index')->with('success', 'Role created successfully');
    }
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,id',
        ]);
        $this->roleRepository->update($validatedData, $id);
        return redirect()->route('roles.index')->with('success', 'Role updated successfully');
    }
    public function delete($id)
    {
        $this->roleRepository->destory($id);
        return redirect()->route('roles.index')->with('success', 'Role deleted successfully');
    }
}

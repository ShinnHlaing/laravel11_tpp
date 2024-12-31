<?php

namespace App\Http\Controllers;

use App\Models\Permission;
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
        $permissions = Permission::all();
        return view('roles.create', compact('permissions'));
    }
    public function edit($id)
    {
        $role = $this->roleRepository->show($id);
        $permissions = Permission::all();
        return view('roles.edit', compact('role', 'permissions'));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'guard_name' => 'nullable',
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        // Set default value for guard_name if not provided
        if (empty($validatedData['guard_name'])) {
            $validatedData['guard_name'] = 'default_guard_name';
        }

        $this->roleRepository->store($validatedData);
        return redirect()->route('roles.index')->with('success', 'Role created successfully');
    }
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'guard_name' => 'nullable',
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,id',
        ]);
        $this->roleRepository->update($validatedData, $id);
        return redirect()->route('roles.index')->with('success', 'Role updated successfully');
    }
    public function delete($id)
    {
        $role = $this->roleRepository->show($id);
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Role deleted successfully');
    }
}

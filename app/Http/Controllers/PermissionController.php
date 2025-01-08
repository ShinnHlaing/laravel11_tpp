<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use App\Repositories\Permission\PermissionRepositoryInterface;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    protected $permissionRepository;

    public function __construct(PermissionRepositoryInterface $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }

    public function index()
    {
        $permissions = $this->permissionRepository->index();
        return view('permissions.index', compact('permissions'));
    }

    public function create()
    {
        $roles = Role::get();
        return view('permissions.create', compact('roles'));
    }

    public function edit($id)
    {
        $permission = $this->permissionRepository->show($id);
        $roles = Role::all();
        $permissionRole = $permission->roles->pluck('id')->toArray();
        return view('permissions.edit', compact('permission', 'roles', 'permissionRole'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'roles' => 'array',
            'roles*.' => 'exists:roles,id'
        ]);

        $this->permissionRepository->store($validatedData);
        return redirect()->route('permissions.index');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'roles' => 'array',
            'roles*.' => 'exists:roles,id'
        ]);

        $this->permissionRepository->update($validatedData, $id);
        return redirect()->route('permissions.index');
    }

    public function delete($id)
    {
        $this->permissionRepository->destory($id);
        return redirect()->route('permissions.index');
    }
}

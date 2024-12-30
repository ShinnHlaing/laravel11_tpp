<?php

namespace App\Http\Controllers;

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
        return view('permissions.create');
    }

    public function edit($id)
    {
        $permission = $this->permissionRepository->show($id);
        return view('permissions.edit', compact('permission'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
        ]);

        if (empty($validatedData['guard_name'])) {
            $validatedData['guard_name'] = 'default_guard_name';
        }
        $this->permissionRepository->store($validatedData);
        return redirect()->route('permissions.index');
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'gurd_name' => 'nullable',
        ]);

        $this->permissionRepository->update($validatedData, $request->id);
        return redirect()->route('permissions.index');
    }

    public function delete($id)
    {
        $permission = $this->permissionRepository->show($id);
        $permission->delete();
        return redirect()->route('permissions.index');
    }
}

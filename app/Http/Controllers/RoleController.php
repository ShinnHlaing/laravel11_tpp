<?php

namespace App\Http\Controllers;

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
        return view('roles.create');
    }
    public function edit($id)
    {
        $role = $this->roleRepository->show($id);
        return view('roles.edit', compact('role'));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'guard_name' => 'nullable',
        ]);

        // Set default value for guard_name if not provided
        if (empty($validatedData['guard_name'])) {
            $validatedData['guard_name'] = 'default_guard_name';
        }

        $this->roleRepository->store($validatedData);
        return redirect()->route('roles.index');
    }
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'guard_name' => 'nullable',
        ]);
        $this->roleRepository->update($validatedData, $request->id);
        return redirect()->route('roles.index');
    }
    public function delete($id)
    {
        $role = $this->roleRepository->show($id);
        $role->delete();
        return redirect()->route('roles.index');
    }
}

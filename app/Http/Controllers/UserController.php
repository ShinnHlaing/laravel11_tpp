<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use App\Services\User\UserService;
use App\Repositories\Role\RoleRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;

class UserController extends Controller
{
    protected $userRepository;
    protected $userService;
    protected $roleRepository;
    public function __construct(UserRepositoryInterface $userRepository, RoleRepositoryInterface $roleRepository, UserService $userService)
    {
        $this->middleware('auth');
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
        $this->userService = $userService;
    }

    public function index()
    {
        $users = $this->userRepository->index();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $roles = $this->roleRepository->index();
        return view('users.create', compact('roles'));
    }

    public function  edit($id)
    {
        $roles =  $this->roleRepository->index();
        $user = $this->userRepository->show($id);
        return view('users.edit', compact('user', 'roles'));
    }

    public function store(UserRequest $request)
    {
        $validatedData = $request->validated();
        if ($request->hasFile('image')) {
            $ImageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('userImages'), $ImageName);
            $validatedData = array_merge($validatedData, ['image' => $ImageName]);
        }
        $user = $this->userRepository->store($validatedData);
        $user->roles()->attach($validatedData['roles']);
        return redirect()->route('users.index');
    }

    public function update(UserUpdateRequest $request, $id)
    {
        $validatedData = $request->validated();
        // dd($validatedData);
        $user = $this->userRepository->show($id);

        if ($request->filled('password')) {
            $validatedData = array_merge($validatedData, ['password' => $request->password]);
        } else {
            unset($validatedData['password']);
        }

        if ($request->hasFile('image')) {
            if ($user->image) {
                $oldImagePath = public_path('userImages') . '/' . $user->image;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            $ImageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('userImages'), $ImageName);
            $validatedData = array_merge($validatedData, ['image' => $ImageName]);
        }
        $user->update($validatedData);
        $user->roles()->sync($validatedData['roles']);

        return redirect()->route('users.index')->with('success', 'user updated successfully.');
    }

    public function delete($id)
    {
        $user = $this->userRepository->show($id);
        if ($user) {
            $user->delete($id);
            return redirect()->route('users.index')->with('success', 'User deleted successfully.');
        } else {
            return redirect()->route('users.index')->with('error', 'User not found.');
        }
    }
    public function status($id)
    {
        $this->userService->status($id);
        return redirect()->route('users.index');
    }
}

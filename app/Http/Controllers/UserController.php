<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userRepository;
    public function __construct(UserRepositoryInterface $userRepository)
    {
        // $this->middleware('auth');
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $users = $this->userRepository->index();
        // dd($users);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    public function  edit($id)
    {
        $roles = Role::all();
        $user = $this->userRepository->show($id);
        return view('users.edit', compact('user', 'roles'));
    }

    public function store(UserRequest $request)
    {
        // dd($request->all());
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
}

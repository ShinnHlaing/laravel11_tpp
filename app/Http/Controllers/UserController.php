<?php

namespace App\Http\Controllers;

use App\Repositories\User\UserRepositoryInterface;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Http\Request;
use App\Models\User;

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
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function  edit($id)
    {
        $user = $this->userRepository->show($id);
        return view('users.edit', compact('user'));
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
        $this->userRepository->store($validatedData);
        return redirect()->route('users.index');
    }

    public function update(UserUpdateRequest $request)
    {
        $validatedData = $request->validated();
        if ($request->filled('password')) {
            $validatedData = array_merge($validatedData, ['password' => $request->password]);
        } else {
            unset($validatedData['password']);
        }
        if ($request->hasFile('image')) {
            $user = $this->userRepository->show($request->id);
            if ($user->image) {
                $oldImagePath = public_path('userImages') . '/' . $user->image;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            $ImageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('userImages'), $ImageName);
            $validatedData = array_merge($validatedData, ['image' => $ImageName]);

            $validated_with_img = [
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'image' => $ImageName,
            ];
            $this->userRepository->update($validated_with_img, $request->id);
        } else {
            $validated_without_img = [
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
            ];
            $this->userRepository->update($validated_without_img, $request->id);
        }
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

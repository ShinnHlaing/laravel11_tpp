<?php

namespace App\Http\Controllers;

use App\Repositories\User\UserRepositoryInterface;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userRepository;
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->middleware('auth');
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
        dd($request->all());
        $validatedData = $request->validated();
        $this->userRepository->store($validatedData);
        return redirect()->route('users.index');
    }

    public function update(UserUpdateRequest $request)
    {
        $validatedData = $request->validated();
        $user = $this->userRepository->show($request->id);
        $user->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'created_at' => $validatedData['date'],
        ]);
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

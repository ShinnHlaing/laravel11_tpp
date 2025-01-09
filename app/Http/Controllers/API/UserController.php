<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\BaseController;
use App\Http\Resources\UserResource;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('roles')->get();
        $data = UserResource::collection($users);
        return $this->success($data, "Users Retrieved Success", 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateUser = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'roles' => 'required|integer',
        ]);
        if ($validateUser->fails()) {
            return $this->error('Validation Error', $validateUser->errors(), 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($request->has('roles')) {
            $user->roles()->sync($request->roles);
        }

        return $this->success($user, 'User Created successfully!', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::with('roles')->where('id', $id)->first();
        if (!$user) {
            return $this->error('User not found', null, 404);
        }
        $data = new UserResource($user);
        return $this->success($data, "User Show Successfully", 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::with('roles')->where('id', $id)->first();
        if (!$user) {
            return $this->error('User not found', null, 404);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|unique:users,email',
            'status' => 'nullable|boolean',
            'roles' => 'nullable|integer'
        ]);
        if ($validator->fails()) {
            return $this->error('Validation Error', $validator->errors(), 422);
        }
        $user->update($request->all());
        if ($request->has('roles')) {
            $user->roles()->sync($request->roles);
        }
        return $this->success($user, "User update successfully", 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::where('id', $id);
        if (!$user) {
            return $this->error('User not found!', null, 404);
        };
        $user->delete();
        return $this->success($user, "User delete successfully", 200);
    }
}

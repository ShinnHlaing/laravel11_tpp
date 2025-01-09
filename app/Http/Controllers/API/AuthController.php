<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController;
use Exception;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class AuthController extends BaseController
{
    public function login(Request $request)
    {
        try {
            $credentials = $request->only(['email', 'password']);
            if (!JWTAuth::attempt($credentials)) {
                return $this->error("Your Email & Password don't match", null, 401);
            }
            $user = User::where('email', $credentials['email'])->first();
            $payload = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'status' => $user->status === 1 ? 'active' : 'inactive',
            ];
            $token = JWTAuth::customClaims($payload)->attempt(['email' => $user->email, 'password' => $credentials['password']]);
            return $this->success($token, "User login successfully", 200);
        } catch (Exception $e) {
            return $this->error($e->getMessage() ? $e->getMessage() : "Something went wrong", null, $e->getCode() ? $e->getCode() : 500);
        }
    }

    public function register(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8',
                'roles' => 'required|integer'
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
        } catch (Exception $e) {
            return $this->error($e->getMessage() ? $e->getMessage() : "Internal server error", null, $e->getCode() ? $e->getCode() : 500);
        }
    }
}

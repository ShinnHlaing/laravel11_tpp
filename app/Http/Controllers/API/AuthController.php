<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController;
use Exception;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use App\Models\User;

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
}

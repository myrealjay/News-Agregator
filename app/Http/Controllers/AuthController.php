<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Traits\HasResponse;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use HasResponse;

    /**
     * Login User.
     *
     * @param LoginRequest $request
     * @throws AuthenticationException
     * @return mixed|JsonResponse
     */
    public function login(LoginRequest $request) : JsonResponse
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw new AuthenticationException('Invalid credentials');
        }

        return $this->sendResponse(
            true,
            'Login successful',
            [
                'access_token' => $user->createToken('auth_token')->plainTextToken,
                'user' => $user,
            ]
        );
    }
}

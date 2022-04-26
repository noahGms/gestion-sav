<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        if (Auth::attempt($request->validated(), $request->get('remember_me'))) {
            $token = Auth::user()->createToken('Personal Access Token');

            return response()->json(['message' => 'Bonjour ' . Auth::user()->fullname])->withCookie('access_token', $token->plainTextToken);
        }

        return response()->json(['message' => 'Identifiants incorrects'], 401);
    }

    /**
     * @return UserResource
     */
    public function whoami(): UserResource
    {
        return UserResource::make(Auth::user());
    }

    /**
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        Auth::user()->tokens()->delete();
        return response()->json(['message' => 'Vous êtes déconnecté']);
    }
}

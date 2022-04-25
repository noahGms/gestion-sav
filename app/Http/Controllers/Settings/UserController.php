<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $users = User::all();
        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserRequest $request
     * @return JsonResponse
     */
    public function store(UserRequest $request): JsonResponse
    {
        User::create($request->validated());
        return response()->json(['message' => 'Utilisateur créé avec succès']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest $request
     * @param User $user
     * @return JsonResponse
     */
    public function update(UserRequest $request, User $user): JsonResponse
    {
        if ($user->is_god) {
            return response()->json(['message' => 'L\'utilisateur ne peut pas être modifié']);
        }
        $user->update($request->validated());
        return response()->json(['message' => 'L\'utilisateur a bien été modifié']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return JsonResponse
     */
    public function destroy(User $user): JsonResponse
    {
        if ($user->is_god) {
            return response()->json(['message' => 'L\'utilisateur ne peut pas être supprimé']);
        }

        $user->delete();
        return response()->json(['message' => 'L\'utilisateur a bien été supprimé']);
    }

    /**
     * @param User $user
     * @return JsonResponse
     */
    public function toggleAdmin(User $user): JsonResponse
    {
        if ($user->is_god) {
            return response()->json(['message' => 'L\'utilisateur ne peut pas être modifié']);
        }
        $user->update(['is_admin' => !$user->is_admin]);
        return response()->json(['message' => 'L\'utilisateur a bien été modifié']);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfilePasswordRequest;
use App\Http\Requests\ProfileRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ProfileController extends Controller
{
    /**
     * @param ProfileRequest $request
     * @return JsonResponse
     */
    public function update(ProfileRequest $request): JsonResponse
    {
        Auth::user()->update($request->validated());
        return response()->json(['message' => 'Le profile à bien été modifié']);
    }

    /**
     * @param ProfilePasswordRequest $request
     * @return JsonResponse
     */
    public function passwordUpdate(ProfilePasswordRequest $request): JsonResponse
    {
        $requestValidated = $request->validated();
        if (!Hash::check($requestValidated['old_password'], Auth::user()->password)) {
            return response()->json(['message' => 'L\'ancien mot de passe est incorrecte']);
        }

        Auth::user()->update([
            'password' => $requestValidated['password']
        ]);

        return response()->json(['message' => 'Le mot de passe à bien été modifié']);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function uploadAvatar(Request $request): JsonResponse
    {
        $request->validate([
            'file' => 'required|file|mimes:jpg,bmp,png'
        ]);

        if ($file = $request->file('file')) {
            if ($currentAvatarPath = Auth::user()->avatar) {
                Storage::delete('avatar/' . $currentAvatarPath);
            }

            $file->storeAs("avatar/" . Auth::id(), $file->hashName());

            Auth::user()->update(['avatar' => Auth::id() . '/' . $file->hashName()]);
        }

        return response()->json(['message' => 'L\'avatar à bien été uploadé']);
    }


    /**
     * @return JsonResponse
     */
    public function removeAvatar(): JsonResponse
    {
        Storage::delete('avatar/' . Auth::user()->avatar);
        Auth::user()->update(['avatar' => null]);

        return response()->json(['message' => 'L\'avatar à bien été supprimé']);
    }

    /**
     * @return StreamedResponse
     */
    public function getAvatar(): StreamedResponse
    {
        return Storage::download('avatar/' . Auth::user()->avatar);
    }
}

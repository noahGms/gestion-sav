<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfilePasswordRequest;
use App\Http\Requests\ProfileRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        return view('profile.index');
    }

    /**
     * @param ProfileRequest $request
     * @return RedirectResponse
     */
    public function update(ProfileRequest $request): RedirectResponse
    {
        Auth::user()->update($request->validated());
        return redirect()->back()->with('success', 'Le profile a bien été modifié');
    }

    /**
     * @param ProfilePasswordRequest $request
     * @return RedirectResponse
     */
    public function passwordUpdate(ProfilePasswordRequest $request): RedirectResponse
    {
        $requestValidated = $request->validated();
        if (!Hash::check($requestValidated['old_password'], Auth::user()->password)) {
            return back()->withErrors(['old_password' => 'Bad old password']);
        }
        Auth::user()->update([
            'password' => $requestValidated['password']
        ]);
        return redirect()->back()->with('success', 'Le mot de passe a bien été modifié');
    }
}

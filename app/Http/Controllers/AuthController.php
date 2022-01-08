<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * @return View
     */
    public function loginView(): View
    {
        return view('auth.login');
    }

    /**
     * @param LoginRequest $request
     * @return RedirectResponse
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        if (Auth::attempt($request->validated(), $request->get('remember_me'))) {
            $request->session()->regenerate();

            return redirect()->route('home.index')->with('success', 'Bonjour ' . Auth::user()->fullname);
        }

        return back()->with('error', 'Les informations de connexion sont inccorectes');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home.index');
    }
}

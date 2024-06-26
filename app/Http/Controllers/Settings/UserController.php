<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\UserRequest;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $users = User::orderBy('created_at', 'desc')->paginate(12);
        return view('settings.users.index', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserRequest $request
     * @return RedirectResponse
     */
    public function store(UserRequest $request): RedirectResponse
    {
        User::create($request->validated());
        return redirect()->back()->with('success', 'L\'utilisateur a bien été créé');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return View|RedirectResponse
     */
    public function edit(User $user)
    {
        if ($user->is_god) {
            return redirect()->route('users.index')->with('error', 'L\'utilisateur ne peut pas être modifié');
        }
        return view('settings.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(UserRequest $request, User $user): RedirectResponse
    {
        if ($user->is_god) {
            return redirect()->route('users.index')->with('error', 'L\'utilisateur ne peut pas être modifié');
        }
        $user->update($request->validated());
        return redirect()->route('users.index')->with('success', 'L\'utilisateur a bien été modifié');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return RedirectResponse
     */
    public function destroy(User $user): RedirectResponse
    {
        if ($user->is_god) {
            return redirect()->route('users.index')->with('error', 'L\'utilisateur ne peut pas être supprimé');
        }

        $user->delete();
        return redirect()->route('users.index')->with('success', 'L\'utilisateur a bien été supprimé');
    }

    /**
     * @param User $user
     * @return RedirectResponse
     */
    public function toggleAdmin(User $user): RedirectResponse
    {
        if ($user->is_god) {
            return redirect()->route('users.index')->with('error', 'L\'utilisateur ne peut pas être modifié');
        }
        $user->update(['is_admin' => !$user->is_admin]);
        return redirect()->route('users.index')->with('success', 'L\'utilisateur a bien été modifié');
    }
}

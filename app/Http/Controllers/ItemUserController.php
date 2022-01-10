<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ItemUserController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param Item $item
     * @return RedirectResponse
     */
    public function store(Request $request, Item $item): RedirectResponse
    {
        try {
            $item->users()->attach($request->validate([
                'user_id' => 'required|string|exists:users,id'
            ]));
        } catch (\Exception $exception) {
            return back()->with('error', 'Une erreur est survenue');
        }
        return back()->with('success', 'Le technicien a bien été ajouté');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Item $item
     * @param User $user
     * @return RedirectResponse
     */
    public function destroy(Item $item, User $user): RedirectResponse
    {
        $item->users()->detach($user);
        return back()->with('success', 'Le technicien a bien été supprimé');
    }
}

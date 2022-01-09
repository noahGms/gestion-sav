<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\StateRequest;
use App\Models\State;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $states = State::orderBy('name')->paginate(12);
        return view('settings.states.index', compact('states'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StateRequest $request
     * @return RedirectResponse
     */
    public function store(StateRequest $request): RedirectResponse
    {
        State::create($request->validated());
        return redirect()->back()->with('success', 'L\'état a bien été créé');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param State $state
     * @return View
     */
    public function edit(State $state): View
    {
        return view('settings.states.edit', compact('state'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StateRequest $request
     * @param State $state
     * @return RedirectResponse
     */
    public function update(StateRequest $request, State $state): RedirectResponse
    {
        $state->update($request->validated());
        return redirect()->route('states.index')->with('success', 'L\'état a bien été modifié');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param State $state
     * @return RedirectResponse
     */
    public function destroy(State $state): RedirectResponse
    {
        $state->delete();
        return redirect()->route('states.index')->with('success', 'L\'état a bien été supprimé');
    }
}

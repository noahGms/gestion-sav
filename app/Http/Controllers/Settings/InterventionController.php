<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\InterventionRequest;
use App\Models\Intervention;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class InterventionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $interventions = Intervention::paginate(12);
        return view('settings.interventions.index', compact('interventions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param InterventionRequest $request
     * @return RedirectResponse
     */
    public function store(InterventionRequest $request): RedirectResponse
    {
        Intervention::create($request->validated());
        return redirect()->back()->with('success', 'Le moyen d\'intervention a bien été créé');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Intervention $intervention
     * @return View
     */
    public function edit(Intervention $intervention): View
    {
        return view('settings.interventions.edit', compact('intervention'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param InterventionRequest $request
     * @param Intervention $intervention
     * @return RedirectResponse
     */
    public function update(InterventionRequest $request, Intervention $intervention): RedirectResponse
    {
        $intervention->update($request->validated());
        return redirect()->route('interventions.index')->with('success', 'Le moyen d\'intervention a bien été modifié');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Intervention $intervention
     * @return RedirectResponse
     */
    public function destroy(Intervention $intervention): RedirectResponse
    {
        $intervention->delete();
        return redirect()->route('interventions.index')->with('success', 'Le moyen d\'intervention a bien été supprimé');
    }
}

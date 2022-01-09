<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\ReturnRequest;
use App\Models\ReturnMdl;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ReturnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $returns = ReturnMdl::orderBy('name')->paginate(12);
        return view('settings.returns.index', compact('returns'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ReturnRequest $request
     * @return RedirectResponse
     */
    public function store(ReturnRequest $request): RedirectResponse
    {
        ReturnMdl::create($request->validated());
        return redirect()->back()->with('success', 'Le moyen de retour a bien été créé');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ReturnMdl $return
     * @return View
     */
    public function edit(ReturnMdl $return): View
    {
        return view('settings.returns.edit', compact('return'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ReturnRequest $request
     * @param ReturnMdl $return
     * @return RedirectResponse
     */
    public function update(ReturnRequest $request, ReturnMdl $return): RedirectResponse
    {
        $return->update($request->validated());
        return redirect()->route('returns.index')->with('success', 'Le moyen de retour a bien été modifié');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ReturnMdl $return
     * @return RedirectResponse
     */
    public function destroy(ReturnMdl $return): RedirectResponse
    {
        $return->delete();
        return redirect()->route('returns.index')->with('success', 'Le moyen de retour a bien été supprimé');
    }
}

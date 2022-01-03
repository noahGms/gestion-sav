<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\DepotRequest;
use App\Models\Depot;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class DepotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $depots = Depot::paginate(12);
        return view('settings.depots.index', compact('depots'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param DepotRequest $request
     * @return RedirectResponse
     */
    public function store(DepotRequest $request): RedirectResponse
    {
        Depot::create($request->validated());
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Depot $depot
     * @return View
     */
    public function edit(Depot $depot): View
    {
        return view('settings.depots.edit', compact('depot'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param DepotRequest $request
     * @param Depot $depot
     * @return RedirectResponse
     */
    public function update(DepotRequest $request, Depot $depot): RedirectResponse
    {
        $depot->update($request->validated());
        return redirect()->route('depots.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Depot $depot
     * @return RedirectResponse
     */
    public function destroy(Depot $depot): RedirectResponse
    {
        $depot->delete();
        return redirect()->route('depots.index');
    }
}

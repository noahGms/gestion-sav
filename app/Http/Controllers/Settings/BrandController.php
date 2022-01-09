<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\BrandRequest;
use App\Models\Brand;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $brands = Brand::orderBy('name')->paginate(12);
        return view('settings.brands.index', compact('brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BrandRequest $request
     * @return RedirectResponse
     */
    public function store(BrandRequest $request): RedirectResponse
    {
        Brand::create($request->validated());
        return redirect()->back()->with('success', 'La marque a bien été créé');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Brand $brand
     * @return View
     */
    public function edit(Brand $brand): View
    {
        return view('settings.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BrandRequest $request
     * @param Brand $brand
     * @return RedirectResponse
     */
    public function update(BrandRequest $request, Brand $brand): RedirectResponse
    {
        $brand->update($request->validated());
        return redirect()->route('brands.index')->with('success', 'La marque a bien été modifié');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Brand $brand
     * @return RedirectResponse
     */
    public function destroy(Brand $brand): RedirectResponse
    {
        $brand->delete();
        return redirect()->route('brands.index')->with('success', 'La marque a bien été supprimé');
    }
}

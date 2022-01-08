<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\TypeRequest;
use App\Models\Category;
use App\Models\Type;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $types = Type::paginate(12);
        $categories = Category::all();
        return view('settings.types.index', compact('types', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TypeRequest $request
     * @return RedirectResponse
     */
    public function store(TypeRequest $request): RedirectResponse
    {
        Type::create($request->validated());
        return redirect()->back()->with('success', 'Le type a bien été créé');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Type $type
     * @return View
     */
    public function edit(Type $type): View
    {
        $categories = Category::all();
        return view('settings.types.edit', compact('type', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TypeRequest $request
     * @param Type $type
     * @return RedirectResponse
     */
    public function update(TypeRequest $request, Type $type): RedirectResponse
    {
        $type->update($request->validated());
        return redirect()->route('types.index')->with('success', 'Le type a bien été modifié');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Type $type
     * @return RedirectResponse
     */
    public function destroy(Type $type): RedirectResponse
    {
        $type->delete();
        return redirect()->route('types.index')->with('success', 'Le type a bien été supprimé');
    }
}

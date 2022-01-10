<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Part;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PartController extends Controller
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
        Part::create(array_merge($request->validate([
            'name' => 'nullable|string',
            'price' => 'nullable|numeric',
            'link' => 'nullable|string'
        ]), [
            'item_id' => $item->id
        ]));

        return back()->with('success', 'Le technicien a bien été ajouté');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Item $item
     * @param Part $part
     * @return RedirectResponse
     */
    public function destroy(Item $item, Part $part): RedirectResponse
    {
        $part->delete();
        return back()->with('success', 'La pièce a bien été supprimé');
    }
}

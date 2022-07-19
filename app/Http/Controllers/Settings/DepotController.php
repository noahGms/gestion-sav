<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\DepotRequest;
use App\Http\Resources\DepotResource;
use App\Models\Depot;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class DepotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $depots = Depot::all();
        return DepotResource::collection($depots);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param DepotRequest $request
     * @return JsonResponse
     */
    public function store(DepotRequest $request): JsonResponse
    {
        $depot = Depot::create($request->validated());
        return response()->json([
            'message' => 'Le moyen de dépot a bien été créé',
            'data' => DepotResource::make($depot)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param DepotRequest $request
     * @param Depot $depot
     * @return JsonResponse
     */
    public function update(DepotRequest $request, Depot $depot): JsonResponse
    {
        $depot->update($request->validated());
        return response()->json(['message' => 'Le moyen de dépot a bien été modifié']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Depot $depot
     * @return JsonResponse
     */
    public function destroy(Depot $depot): JsonResponse
    {
        $depot->delete();
        return response()->json(['message' => 'Le moyen de dépot a bien été supprimé']);
    }
}

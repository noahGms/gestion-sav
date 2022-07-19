<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\InterventionRequest;
use App\Http\Resources\InterventionResource;
use App\Models\Intervention;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class InterventionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $interventions = Intervention::all();
        return InterventionResource::collection($interventions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param InterventionRequest $request
     * @return JsonResponse
     */
    public function store(InterventionRequest $request): JsonResponse
    {
        $intervention = Intervention::create($request->validated());
        return response()->json([
            'message' => 'Le moyen d\'intervention a bien été créé',
            'data' => InterventionResource::make($intervention)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param InterventionRequest $request
     * @param Intervention $intervention
     * @return JsonResponse
     */
    public function update(InterventionRequest $request, Intervention $intervention): JsonResponse
    {
        $intervention->update($request->validated());
        return response()->json(['message' => 'Le moyen d\'intervention a bien été modifié']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Intervention $intervention
     * @return JsonResponse
     */
    public function destroy(Intervention $intervention): JsonResponse
    {
        $intervention->delete();
        return response()->json(['message' => 'Le moyen d\'intervention a bien été supprimé']);
    }
}

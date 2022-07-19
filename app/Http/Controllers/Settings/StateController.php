<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\StateRequest;
use App\Http\Resources\StateResource;
use App\Models\State;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $states = State::all();
        return StateResource::collection($states);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StateRequest $request
     * @return JsonResponse
     */
    public function store(StateRequest $request): JsonResponse
    {
        $state = State::create($request->validated());
        return response()->json([
            'message' => "L'état a bien été créé",
            'data' => StateResource::make($state)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StateRequest $request
     * @param State $state
     * @return JsonResponse
     */
    public function update(StateRequest $request, State $state): JsonResponse
    {
        $state->update($request->validated());
        return response()->json(['message' => "L'état a bien été modifié"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param State $state
     * @return JsonResponse
     */
    public function destroy(State $state): JsonResponse
    {
        $state->delete();
        return response()->json(['message' => "L'état a bien été supprimé"]);
    }
}

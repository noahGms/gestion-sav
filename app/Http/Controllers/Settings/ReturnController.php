<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\ReturnRequest;
use App\Http\Resources\ReturnResource;
use App\Models\ReturnMdl;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ReturnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $returns = ReturnMdl::all();
        return ReturnResource::collection($returns);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ReturnRequest $request
     * @return JsonResponse
     */
    public function store(ReturnRequest $request): JsonResponse
    {
        $return = ReturnMdl::create($request->validated());
        return response()->json([
            'message' => 'Le moyen de retour a bien été créé',
            'data' => ReturnResource::make($return)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ReturnRequest $request
     * @param ReturnMdl $return
     * @return JsonResponse
     */
    public function update(ReturnRequest $request, ReturnMdl $return): JsonResponse
    {
        $return->update($request->validated());
        return response()->json(['message' => 'Le moyen de retour a bien été modifié']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ReturnMdl $return
     * @return JsonResponse
     */
    public function destroy(ReturnMdl $return): JsonResponse
    {
        $return->delete();
        return response()->json(['message' => 'Le moyen de retour a bien été supprimé']);
    }
}

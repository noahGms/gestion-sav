<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\TypeRequest;
use App\Http\Resources\TypeResource;
use App\Models\Type;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $types = Type::all();
        return TypeResource::collection($types);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TypeRequest $request
     * @return JsonResponse
     */
    public function store(TypeRequest $request): JsonResponse
    {
        Type::create($request->validated());
        return response()->json(['message' => 'Le type a bien été créé']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TypeRequest $request
     * @param Type $type
     * @return JsonResponse
     */
    public function update(TypeRequest $request, Type $type): JsonResponse
    {
        $type->update($request->validated());
        return response()->json(['message' => 'Le type a bien été modifié']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Type $type
     * @return JsonResponse
     */
    public function destroy(Type $type): JsonResponse
    {
        $type->delete();
        return response()->json(['message' => 'Le type a bien été supprimé']);
    }
}

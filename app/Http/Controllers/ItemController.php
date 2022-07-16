<?php

namespace App\Http\Controllers;

use App\Http\Resources\ItemResource;
use App\Models\Item;
use App\Services\ItemService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ItemController extends Controller
{
    /**
     * @var ItemService
     */
    private $itemService;

    public function __construct(ItemService $itemService)
    {
        $this->itemService = $itemService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = Item::query();

        if ($request->filled('state_id')) {
            $query->where('state_id', $request->get('state_id'));
        }

        if ($request->filled('brand_id')) {
            $query->where('brand_id', $request->get('brand_id'));
        }

        if ($request->filled('type_id')) {
            $query->where('type_id', $request->get('type_id'));
        }

        if ($request->filled('with_archived')) {
            if ($request->get('with_archived') === 'yes') {
                $query->where('archived_at', '!=', null);
            } else if ($request->get('with_archived') === 'no') {
                $query->where('archived_at', null);
            }
        } else {
            $query->where('archived_at', null);
        }

        if (!$request->filled('intervention_date')) {
             $request['intervention_date'] = 'desc';
        }

        $query->orderBy('intervention_date', $request->get('intervention_date'));

        $items = $query->paginate(12);

        return ItemResource::collection($items);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $this->itemService->store($request);
        return response()->json(['message' => 'L\'item a bien été créé']);
    }

    /**
     * Display the specified resource.
     *
     * @param Item $item
     * @return ItemResource
     */
    public function show(Item $item): ItemResource
    {
        return ItemResource::make($item);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Item $item
     * @return JsonResponse
     */
    public function update(Request $request, Item $item): JsonResponse
    {
        $this->itemService->update($request, $item);
        return response()->json(['message' => 'L\'item a bien été modifié']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Item $item
     * @return JsonResponse
     */
    public function destroy(Item $item): JsonResponse
    {
        $this->itemService->delete($item);
        return response()->json(['message' => 'L\'item a bien été supprimé']);
    }

    /**
     * Archive the specified resource from storage.
     *
     * @param Item $item
     * @return JsonResponse
     */
    public function archive(Item $item): JsonResponse
    {
        $item->archived_at = Carbon::now();
        $item->save();
        return response()->json(['message' => 'L\'item a bien été archivé']);
    }

    /**
     * Unarchive the specified resource from storage.
     *
     * @param Item $item
     * @return JsonResponse
     */
    public function unarchive(Item $item): JsonResponse
    {
        $item->archived_at = null;
        $item->save();
        return response()->json(['message' => 'L\'item a bien été déarchivé']);
    }
}

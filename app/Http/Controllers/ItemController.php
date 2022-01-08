<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Customer;
use App\Models\Depot;
use App\Models\Intervention;
use App\Models\Item;
use App\Models\ReturnMdl;
use App\Models\State;
use App\Models\Type;
use App\Models\User;
use App\Services\ItemService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

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
     * @return View
     */
    public function index(): View
    {
        $items = Item::paginate(12);
        $itemsCount = Item::count();
        return view('items.index', compact('items', 'itemsCount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $states = State::all();
        $interventions = Intervention::all();
        $depots = Depot::all();
        $returns = ReturnMdl::all();
        $types = Type::all();
        $brands = Brand::all();
        $customers = Customer::all();
        $users = User::where('is_god', '=', false)->get();
        return view('items.create', compact('states', 'interventions', 'depots', 'returns', 'types', 'brands', 'customers', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $this->itemService->store($request);
        return redirect()->route('items.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Item $item
     * @return View
     */
    public function show(Item $item): View
    {
        return view('items.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Item $item
     * @return View
     */
    public function edit(Item $item): View
    {
        $states = State::all();
        $interventions = Intervention::all();
        $depots = Depot::all();
        $returns = ReturnMdl::all();
        $types = Type::all();
        $brands = Brand::all();
        return view('items.edit', compact('item', 'states', 'interventions', 'depots', 'returns', 'types', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Item $item
     * @return RedirectResponse
     */
    public function update(Request $request, Item $item): RedirectResponse
    {
        $this->itemService->update($request, $item);
        return redirect()->route('items.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Item $item
     * @return RedirectResponse
     */
    public function destroy(Item $item): RedirectResponse
    {
        $this->itemService->delete($item);
        return redirect()->route('items.index');
    }
}

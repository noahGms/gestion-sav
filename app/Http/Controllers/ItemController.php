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
use Carbon\Carbon;
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
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $query = Item::query();
        $itemsCount = Item::count();

        $states = State::all();
        $brands = Brand::all();
        $types = Type::all();

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
        return view('items.index', compact('items', 'itemsCount', 'states', 'brands', 'types'));
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
        return redirect()->route('items.index')->with('success', 'L\'item a bien été créé');
    }

    /**
     * Display the specified resource.
     *
     * @param Item $item
     * @return View
     */
    public function show(Item $item): View
    {
        $users = User::where('is_god', '=', false)->get();
        return view('items.show', compact('item', 'users'));
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
        return redirect()->route('items.index')->with('success', 'L\item a bien été modifié');
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
        return redirect()->route('items.index')->with('success', 'L\item a bien été supprimé');
    }

    /**
     * Archive the specified resource from storage.
     *
     * @param Item $item
     * @return RedirectResponse
     */
    public function archive(Item $item): RedirectResponse
    {
        $item->archived_at = Carbon::now();
        $item->save();
        return redirect()->route('items.index')->with('success', 'L\item a bien été archivé');
    }

    /**
     * Unarchive the specified resource from storage.
     *
     * @param Item $item
     * @return RedirectResponse
     */
    public function unarchive(Item $item): RedirectResponse
    {
        $item->archived_at = null;
        $item->save();
        return redirect()->route('items.index')->with('success', 'L\item a bien été unarchivé');
    }
}

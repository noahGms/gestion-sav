<?php

namespace App\Services;

use App\Http\Requests\ItemRequest;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemService
{
    /**
     * @var CustomerService
     */
    private $customerService;


    /**
     * ItemService constructor.
     *
     * @param CustomerService $customerService
     */
    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    /**
     * @param Request $request
     * @return Item $item
     */
    public function store(Request $request): Item
    {
        if (!$request->get("customer_id")) {
            $customer = $this->customerService->store($request);
        }

        $itemPayload = $request->validate((new ItemRequest())->rules());
        $item = Item::create(array_merge($itemPayload, [
            'customer_id' => $customer->id ?? $request->get('customer_id'),
            'created_by' => Auth::id()
        ]));

        return $item;
    }

    /**
     * @param Request $request
     * @param Item $item
     * @return Item $item
     */
    public function update(Request $request, Item $item): Item
    {
        $itemPayload = $request->validate((new ItemRequest())->rules());

        $item->update($itemPayload);
        $this->customerService->update($request, $item->customer);

        return $item;
    }

    /**
     * @param Item $item
     * @return void
     */
    public function delete(Item $item)
    {
        $item->delete();
    }
}

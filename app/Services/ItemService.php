<?php

namespace App\Services;

use App\Http\Requests\ItemRequest;
use App\Http\Requests\ItemUserRequest;
use App\Models\File;
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
     * @var PartService
     */
    private $partService;

    /**
     * @var FileService
     */
    private $fileService;

    /**
     * ItemService constructor.
     *
     * @param CustomerService $customerService
     * @param PartService $partService
     * @param FileService $fileService
     */
    public function __construct(CustomerService $customerService, PartService $partService, FileService $fileService)
    {
        $this->customerService = $customerService;
        $this->partService = $partService;
        $this->fileService = $fileService;
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

        $usersPayload = $request->validate((new ItemUserRequest())->rules());
        if (!empty($usersPayload['users'])) {
            $item->users()->sync($usersPayload['users']);
        }

        $this->fileService->store($request, $item);

        $this->partService->store($request, $item);

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

        $usersPayload = $request->validate((new ItemUserRequest())->rules());
        if (!empty($usersPayload['users'])) {
            $item->users()->sync($usersPayload['users']);
        }

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

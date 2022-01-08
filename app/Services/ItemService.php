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
     * ItemService constructor.
     *
     * @param CustomerService $customerService
     * @param PartService $partService
     */
    public function __construct(CustomerService $customerService, PartService $partService)
    {
        $this->customerService = $customerService;
        $this->partService = $partService;
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
            $item->users()->attach(array_filter($usersPayload['users'], function($value) {
                return  $value != null;
            }));
        }

        if (!empty($request->allFiles())) {
            $files = $request->allFiles();
            foreach ($files['files'] as $file) {
                $file->store('/files', 'public');
                File::create([
                    'path' => "/files/{$file->hashName()}",
                    'name' => $file->getClientOriginalName(),
                    'type' => $file->getClientMimeType(),
                    'item_id' => $item->id
                ]);
            }
        }

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

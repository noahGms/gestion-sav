<?php

namespace App\Services;

use App\Http\Requests\PartRequest;
use App\Models\Item;
use App\Models\Part;
use Illuminate\Http\Request;

class PartService
{
    /**
     * @param Request $request
     * @param Item $item
     *
     * @return void
     */
    public function store(Request $request, Item $item)
    {
        $partPayload = $request->validate((new PartRequest())->rules());

        if (empty($partPayload)) return;

        foreach ($partPayload["parts"] as $part) {
            $properties = array_filter($part, function ($value) {
                return $value != null;
            });

            if (empty($properties)) continue;

            Part::create(array_merge($part, [
                'item_id' => $item->id
            ]));
        }
    }
}

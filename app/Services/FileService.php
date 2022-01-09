<?php

namespace App\Services;

use App\Models\File;
use App\Models\Item;
use Illuminate\Http\Request;

class FileService
{
    /**
     * @param Request $request
     * @param Item $item
     * @return void
     */
    public function store(Request $request, Item $item): void
    {
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
    }
}

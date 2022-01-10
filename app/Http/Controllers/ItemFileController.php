<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Item;
use App\Services\FileService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ItemFileController extends Controller
{
    /**
     * @var FileService
     */
    private $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param Item $item
     * @return RedirectResponse
     */
    public function store(Request $request, Item $item): RedirectResponse
    {
        $this->fileService->store($request, $item);
        return back()->with('success', 'Le ou les documents a/ont bien été ajouté');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Item $item
     * @param File $file
     * @return RedirectResponse
     */
    public function destroy(Item $item, File $file): RedirectResponse
    {
        try {
            unlink(storage_path('app/public' . $file->path));
            $file->delete();
        } catch (\Exception $exception) {
            return back()->with('error', 'Une erreur est survenue');
        }
        return back()->with('success', 'Le document a bien été supprimé');
    }
}

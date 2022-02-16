<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Item;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $items_in_progress = Item::where('archived_at', null)->count();
        $items_archived = Item::where('archived_at', '!=', null)->count();
        $total_item = Item::count();
        $total_customer = Customer::count();

        $items = Item::where('archived_at', null)->paginate();

        return view('home', compact('items_in_progress', 'items_archived', 'total_item', 'total_customer', 'items'));
    }
}

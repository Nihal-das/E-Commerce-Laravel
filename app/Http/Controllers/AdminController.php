<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function report(Request $request)
    {
        $query = Item::with(['transactions', 'orderItems']);

        // Filter by date if provided
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereHas('transactions', function ($q) use ($request) {
                $q->whereBetween('created_at', [$request->start_date, $request->end_date]);
            });
        }

        $items = $query->get();

        return view('admin.report', compact('items'));
    }

    public function show()
    {
        $available_stock = Item::all()->where('status', 1);


        return view('admin.store_stock', ['available_stocks' => $available_stock]);
    }

    public function store(Request $request, Item $item)
{
    $validated = $request->validate([
        'add_quantity' => 'required|integer|min:1',
    ]);

    $item->increment('stock_quantity', $validated['add_quantity']);

    return back()->with('success', 'Stock updated successfully!');
}
}

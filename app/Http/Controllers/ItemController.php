<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Nette\Utils\Image;

class ItemController extends Controller
{

    public function show_all(Request $request)
{
    
    $query = Item::where('status', 1);

    if ($request->filled('search')) {
        $query->where('item_name', 'like', '%' . $request->search . '%');
    }

    $all_items = $query->get();

     $cartCount = Cart::where('user_id', Auth::id())->count();

    return view('components.hero', [
        'items' => $all_items,
        'cartCount' => $cartCount,
    ]);
}


    public function create()
    {
        return view('items.create');
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'item_name' => 'required|string|max:255',
            'price' => 'required|integer',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Store image
        $path = $request->file('image')->store('items', 'public');

        Item::create([
            'user_id' => Auth::id(),
            'item_name' => $validated['item_name'],
            'price' => $validated['price'],
            'stock_quantity' => 0,
            'description' => $validated['description'] ?? null,
            'image_path' => $path,
            'status' => true,
        ]);

        return redirect()
            ->route('items.create')
            ->with('success', 'Item created successfully');
    }


    public function show(Item $item)
    {
        return view('items.show', ['item' => $item]);
    }

    public function edit(Item $item)
    {
        return view('items.edit', ['item' => $item]);
    }


    public function update(Request $request, Item $item)
    {
        $validated = $request->validate([
            'item_name'   => 'required|string|max:255',
            'price'       => 'required|integer',
            'description' => 'nullable|string',
            'image_path'  => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // If image uploaded, store & replace
        if ($request->hasFile('image_path')) {
            $path = $request->file('image_path')->store('items', 'public');
            $validated['image_path'] = $path;
        } else {
            unset($validated['image_path']);
        }

        $item->update([
            'user_id'     => Auth::id(),
            'item_name'   => $validated['item_name'],
            'price'       => $validated['price'],
            'description' => $validated['description'] ?? null,
            'image_path'  => $validated['image_path'] ?? $item->image_path,
        ]);

        return redirect()
            ->route('items.show_one', $item->id)
            ->with('success', 'Item updated successfully');
    }
}

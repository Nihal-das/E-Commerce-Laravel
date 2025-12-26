<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Nette\Utils\Image;
use Illuminate\Support\Facades\Validator;

use App\Exports\ItemsExport;
use Maatwebsite\Excel\Facades\Excel;

use Barryvdh\DomPDF\Facade\Pdf;



class ItemController extends Controller
{

    public function show_all(Request $request)
    {

        $query = Item::where('status', 1)->latest();

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

    public function show_upload()
    {
        return view('items.upload');
    }




    public function upload(Request $request)
    {
        // 1️⃣ Validate file upload
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt|max:2048',
        ]);

        $file = fopen($request->file('csv_file')->getRealPath(), 'r');

        // Skip header row
        fgetcsv($file);

        $rowNumber = 1;
        $errors = [];
        $insertedCount = 0;

        DB::beginTransaction();

        try {
            while (($row = fgetcsv($file)) !== false) {
                $rowNumber++;

                // 🛑 Skip empty rows
                if (count(array_filter($row)) === 0) {
                    continue;
                }

                // 🛑 Column count check (CSV discipline)
                if (count($row) !== 3) {
                    $errors[] = "Row {$rowNumber}: Invalid column count.";
                    continue;
                }

                // Row-level validation
                $validator = Validator::make([
                    'item_name'      => trim($row[0]),
                    'price'          => $row[1],
                    'stock_quantity' => $row[2],
                ], [
                    'item_name'      => 'required|string|max:255',
                    'price'          => 'required|numeric|min:0',
                    'stock_quantity' => 'required|integer|min:0',
                ]);

                if ($validator->fails()) {
                    $errors[] = "Row {$rowNumber}: " . implode(', ', $validator->errors()->all());
                    continue;
                }

                // 🔁 Prevent duplicates (by item_name)
                $exists = Item::where('item_name', trim($row[0]))->exists();

                if ($exists) {
                    $errors[] = "Row {$rowNumber}: Item already exists.";
                    continue;
                }

                // ✅ Insert item
                Item::create([
                    'user_id'     => Auth::id(),
                    'item_name'      => trim($row[0]),
                    'description'  =>  "something",
                    'status'      => 1,
                    'image_path'  => "something",
                    'price'          => (float) $row[1],
                    'stock_quantity' => (int) $row[2],
                ]);

                $insertedCount++;
            }

            DB::commit();
            fclose($file);

            // 🚦 If some rows failed, show both success + errors
            if (!empty($errors)) {
                return back()
                    ->withErrors($errors)
                    ->with('success', "{$insertedCount} items imported successfully.");
            }

            return back()->with('success', "All {$insertedCount} items imported successfully 🚀");
        } catch (\Exception $e) {
            DB::rollBack();
            fclose($file);

            return back()->withErrors([
                'Something went wrong while importing the CSV. Please check the file format.',
                $e->getMessage(),
            ]);
        }
    }



    public function exportExcel()
    {
        return Excel::download(new ItemsExport, 'items.xlsx');
    }


    public function exportPdf()
    {
        $items = DB::table('items')
            ->select(
                'items.id',
                'items.item_name',
                'items.price',
                'items.stock_quantity'
            )
            ->orderBy('items.id')
            ->get();

        $pdf = Pdf::loadView('pdf.items', compact('items'))
            ->setPaper('A4', 'portrait');

        return $pdf->download('items.pdf');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\OrderItem;
use App\Models\ItemTransactions;


class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        // Security check — never trust vibes
        if ($order->user_id !==  Auth::id()) {
            abort(403);
        }

        $order->load('orderItems.item');

        return view('orders.show', compact('order'));
    }

    public function return(Request $request)
    {
        $request->validate([
            'order_item_id' => 'required|exists:order_items,id',
            'quantity' => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($request) {

            $orderItem = OrderItem::with('order', 'item')->lockForUpdate()->findOrFail($request->order_item_id);

            // Security check — no funny business
            if ($orderItem->order->user_id !== Auth::id()) {
                abort(403);
            }

            $remaining = $orderItem->quantity - $orderItem->returned_quantity;

            if ($request->quantity > $remaining) {
                throw new \Exception('Invalid return quantity');
            }

            // 1️⃣ Update returned quantity
            $orderItem->increment('returned_quantity', $request->quantity);

            // 2️⃣ Restore stock
            $orderItem->item->increment('stock_quantity', $request->quantity);

            // 3️⃣ Log transaction
            ItemTransactions::create([
                'item_id' => $orderItem->item_id,
                'user_id' => Auth::id(),
                'transaction_type' => 2, // RETURN
                'quantity' => $request->quantity,
            ]);

            // 4️⃣ Reduce order total
            $refund = $request->quantity * $orderItem->price;

            $orderItem->order->decrement('total_amount', $refund);
        });

        return back()->with('success', 'Item returned successfully');
    }
}

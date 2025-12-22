<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\ItemTransactions;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function show()
    {
        $cartItems = Cart::with('item')
            ->where('user_id', Auth::id())
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect('/cart')->with('error', 'Your cart is empty');
        }

        $total = $cartItems->sum(
            fn($c) =>
            $c->quantity * $c->item->price
        );

        return view('checkout.show', compact('cartItems', 'total'));
    }

    public function store()
    {
        $user = Auth::user();

        $cartItems = Cart::with('item')
            ->where('user_id', $user->id)
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.show');
        }

        foreach ($cartItems as $cartItem) {
            $item = $cartItem->item;

            if ($item->stock_quantity < $cartItem->quantity) {
                return redirect()
                    ->back()
                    ->with('error', "Sorry, only {$item->stock_quantity} units of {$item->item_name} are available.");
            }
        }

        DB::transaction(function () use ($cartItems, $user, &$order) {

            $order = Order::create([
                'user_id' => $user->id,
                'order_number' => 'ORD-' . strtoupper(uniqid()),
                'total_amount' => 0,
                'status' => 1,
            ]);

            $total = 0;

            foreach ($cartItems as $cartItem) {
                $item = $cartItem->item;

                OrderItem::create([
                    'order_id' => $order->id,
                    'item_id' => $item->id,
                    'price' => $item->price,
                    'quantity' => $cartItem->quantity,
                    'subtotal' => $item->price * $cartItem->quantity,
                ]);

                $item->decrement('stock_quantity', $cartItem->quantity);

                ItemTransactions::create([
                    'item_id' => $item->id,
                    'user_id' => $user->id,
                    'transaction_type' => 1, // SOLD
                    'quantity' => $cartItem->quantity,
                ]);

                $total += $item->price * $cartItem->quantity;
            }

            $order->update(['total_amount' => $total]);

            Cart::where('user_id', $user->id)->delete();
        });

        return redirect()->route('checkout.success', $order);
    }


    public function success(Order $order)
    {
        return view('checkout.success', compact('order'));
    }
}

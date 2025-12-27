<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Framework\Constraint\Count;

class CartController extends Controller
{

    public function show()
    {
        $cartItems = Cart::with('item')
            ->where('user_id', Auth::id())
            ->get();

        $total = 0;

        foreach ($cartItems as $cartItem) {
            $total += $cartItem->quantity * $cartItem->item->price;
        }

        return view('cart.show', [
            'cartItems' => $cartItems,
            'total' => $total,
        ]);
    }

    public function add(Item $item)
    {
        $userId = Auth::id();

        $cartItem = Cart::where('user_id', $userId)
            ->where('item_id', $item->id)
            ->first();

        if ($cartItem) {
            $cartItem->increment('quantity');
        } else {
            Cart::create([
                'user_id' => $userId,
                'item_id' => $item->id,
                'quantity' => 1,
            ]);
        }

        return back()->with('success', 'Item added to cart');
    }

    public function destroy(Cart $cart)
    {
        
        if ($cart->user_id !== Auth::id()) {
            abort(403);
        }

        $cart->delete();

        return back()->with('success', 'Item removed from cart');
    }


    public function increment(Cart $cart)
    {
        if ($cart->user_id !== Auth::id()) {
            abort(403);
        }

        $cart->quantity++;
        $cart->save();
        return back();
    }

    public function decrement(Cart $cart)
    {
        if ($cart->user_id !== Auth::id()) {
            abort(403);
        }

        if ($cart->quantity > 1) {
            $cart->quantity--;
            $cart->save();
        } else {
            $cart->delete(); // if quantity: 0  = remove
        }

        return back();
    }
}

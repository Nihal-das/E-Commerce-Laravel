<x-layout>
    <x-slot:heading>Checkout</x-slot:heading>

    <div class="bg-gray-900 min-h-screen py-16 pt-40">
        <div class="mx-auto max-w-4xl space-y-8">

           

            <h2 class="text-3xl font-bold text-white">
                Review your order
            </h2>

            <!-- CART ITEMS -->
            <div class="space-y-4">
                @foreach ($cartItems as $cartItem)
            <div class="pt-20 flex justify-center bg-gradient-to-r from-black via-gray-900 to-black">
                 @if (session('error'))
               <div class="rounded-lg bg-green-600 px-6 py-3 text-white text-center shadow-lg animate-bounce">
                {{ session('success') }}
            </div>
            @endif
            </div>
                    <div class="flex justify-between items-center
                                rounded-xl bg-gray-800 p-5">

                        <div class="flex items-center gap-4">
                            <img
                                src="{{ asset('storage/' . $cartItem->item->image_path) }}"
                                class="h-16 w-16 rounded-lg object-cover"
                            />

                            <div>
                                <p class="text-white font-semibold">
                                    {{ $cartItem->item->item_name }}
                                </p>
                                <p class="text-gray-400 text-sm">
                                    ₹{{ $cartItem->item->price }} × {{ $cartItem->quantity }}
                                </p>
                            </div>
                        </div>

                        <p class="text-emerald-400 font-bold">
                            ₹{{ $cartItem->item->price * $cartItem->quantity }}
                        </p>
                    </div>
                @endforeach
            </div>

            <!-- TOTAL -->
            <div class="flex justify-between items-center
                        rounded-xl bg-gray-800 p-6">
                <span class="text-xl font-semibold text-white">
                    Total Amount
                </span>
                <span class="text-3xl font-bold text-emerald-400">
                    ₹{{ $total }}
                </span>
            </div>

            <!-- ACTIONS -->
            <form method="POST" action="{{ route('checkout.store') }}">
                @csrf

                <div class="flex justify-end gap-4">
                    <a href="{{ route('cart.show') }}"
                       class="rounded-lg bg-gray-700 px-6 py-2
                              font-semibold text-white hover:bg-gray-600">
                        Back to Cart
                    </a>

                    <button
                        type="submit"
                        class="rounded-lg bg-indigo-600 px-6 py-2
                               font-semibold text-white hover:bg-indigo-700">
                        Place Order
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-layout>

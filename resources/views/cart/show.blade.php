<x-layout>
    <x-slot:heading>Your Cart</x-slot:heading>

    <div class="bg-gray-900 min-h-screen py-16 pt-40">
        <div class="mx-auto max-w-4xl">

            @if ($cartItems->isEmpty())
                <div class="rounded-xl bg-gray-800 p-8 text-center">
                    <p class="text-xl text-gray-300">
                        Your cart is empty 🛒
                    </p>
                    <a href="/"
                       class="mt-4 inline-block rounded-lg bg-indigo-600 px-6 py-2
                              font-semibold text-white hover:bg-indigo-700">
                        Continue Shopping
                    </a>
                </div>
            @else

                <div class="space-y-6">
                    @foreach ($cartItems as $cartItem)
                        <div class="flex flex-row justify-between rounded-2xl
                                    bg-gray-800 p-6 shadow-lg">

                            <!-- IMAGE + NAME -->
                            <div class="flex flex-[0.5] items-center gap-6">
                                <img
                                    src="{{ asset('storage/' . $cartItem->item->image_path) }}"
                                    class="h-24 w-24 rounded-xl object-cover"
                                    alt="{{ $cartItem->item->item_name }}"
                                />

                                <div>
                                    <h3 class="text-xl flex-[1.5] font-semibold text-white">
                                        {{ $cartItem->item->item_name }}
                                    </h3>
                                    <p class="text-gray-400 ">
                                        ₹{{ $cartItem->item->price }} each
                                    </p>
                                </div>
                            </div>

                            <!-- QUANTITY -->
                            <div class="text-center mt-5">
                                <p class="text-gray-400">Qty</p>
                                <p class="text-lg font-semibold text-white">
                                    {{ $cartItem->quantity }}
                                </p>
                            </div>

                            <!-- SUBTOTAL -->
                            <div class="text-right mt-5">
                                <p class="text-gray-400">Subtotal</p>
                                <p class="text-xl font-bold text-emerald-400">
                                    ₹{{ $cartItem->quantity * $cartItem->item->price }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- TOTAL -->
                <div class="mt-10 flex justify-between items-center
                            rounded-2xl bg-gray-800 p-6">
                    <p class="text-2xl font-semibold text-white">
                        Total
                    </p>
                    <p class="text-3xl font-bold text-emerald-400">
                        ₹{{ $total }}
                    </p>
                </div>

                <!-- ACTIONS -->
                <div class="mt-8 flex justify-end gap-6">
                   <a href="/"
                       class="mt-4 inline-block rounded-lg bg-indigo-600 px-6 py-2
                              font-semibold text-white hover:bg-indigo-700">
                        Continue Shopping
                    </a>

                    <a href="/checkout"
                       class="mt-4 inline-block rounded-lg bg-indigo-600 px-6 py-2
                              font-semibold text-white hover:bg-indigo-700">
                        Checkout
                    </a>
                </div>

            @endif

        </div>
    </div>
</x-layout>

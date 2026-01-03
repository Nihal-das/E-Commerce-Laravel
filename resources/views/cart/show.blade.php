<x-layout>
    <x-slot:heading>Your Cart</x-slot:heading>

    <div class="min-h-screen bg-gray-900 px-4 py-10 sm:px-6 lg:px-12">
        <div class="mx-auto max-w-4xl pt-28">

            @if ($cartItems->isEmpty())
                <div class="rounded-2xl bg-gray-800 p-8 text-center">
                    <p class="text-xl text-gray-300">
                        Your cart is empty 🛒
                    </p>
                    <a href="/"
                       class="mt-6 inline-block rounded-lg bg-indigo-600 px-6 py-2
                              font-semibold text-white hover:bg-indigo-700">
                        Continue Shopping
                    </a>
                </div>
            @else

                <div class="space-y-6">
                    @foreach ($cartItems as $cartItem)
                        <div
                            class="flex flex-col gap-6 rounded-2xl
                                   bg-gray-800 p-6 shadow-lg
                                   sm:flex-row sm:items-center sm:justify-between">

                            <!-- IMAGE + NAME -->
                            <div class="flex items-center gap-4 sm:flex-[2]">
                                <img
                                    src="{{ asset('storage/' . $cartItem->item->image_path) }}"
                                    class="h-20 w-20 rounded-xl object-cover sm:h-24 sm:w-24"
                                    alt="{{ $cartItem->item->item_name }}"
                                />

                                <div>
                                    <h3 class="text-lg font-semibold text-white sm:text-xl">
                                        {{ $cartItem->item->item_name }}
                                    </h3>
                                    <p class="text-sm text-gray-400">
                                        ₹{{ $cartItem->item->price }} each
                                    </p>
                                </div>
                            </div>

                            <!-- QUANTITY CONTROLS -->
                            <div
                                class="flex items-center justify-between
                                       sm:justify-center sm:gap-4 mr-10 ">

                                <form action="{{ route('cart.decrement', $cartItem->id) }}" method="POST">
                                    @csrf
                                    <button
                                        type="submit"
                                        class="rounded-lg bg-indigo-600 px-4 py-2
                                               font-semibold text-white hover:bg-indigo-700">
                                        −
                                    </button>
                                </form>

                                <div class="text-center">
                                    <p class="text-xs text-gray-400">Qty</p>
                                    <p class="text-lg font-semibold text-white">
                                        {{ $cartItem->quantity }}
                                    </p>
                                </div>

                                <form action="{{ route('cart.increment', $cartItem->id) }}" method="POST">
                                    @csrf
                                    <button
                                        type="submit"
                                        class="rounded-lg bg-indigo-600 px-4 py-2
                                               font-semibold text-white hover:bg-indigo-700">
                                        +
                                    </button>
                                </form>
                            </div>

                            <!-- PRICE + REMOVE -->
                            <div
                                class="flex items-center justify-start gap-4
                                       sm:flex-col sm:items-end sm:gap-2 ">

                                <div class="text-right">
                                    <p class="text-xs text-gray-400">Subtotal</p>
                                    <p class="text-xl font-bold text-emerald-400">
                                        ₹{{ $cartItem->quantity * $cartItem->item->price }}
                                    </p>
                                </div>

                                <form method="POST" action="{{ route('cart.destroy', $cartItem->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        type="submit"
                                        class="rounded-lg bg-red-600 px-3 py-2
                                               text-sm font-semibold text-white
                                               hover:bg-red-700">
                                        REMOVE 
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- TOTAL -->
                <div
                    class="mt-10 flex flex-col gap-4
                           rounded-2xl bg-gray-800 p-6
                           sm:flex-row sm:items-center sm:justify-between">
                    <p class="text-2xl font-semibold text-white">
                        Total
                    </p>
                    <p class="text-3xl font-bold text-emerald-400">
                        ₹{{ $total }}
                    </p>
                </div>

                <!-- ACTIONS -->
                <div
                    class="mt-8 flex flex-col gap-4
                           sm:flex-row sm:justify-end sm:gap-6">
                    <a href="/"
                       class="rounded-lg bg-indigo-600 px-6 py-2
                              text-center font-semibold text-white hover:bg-indigo-700">
                        Continue Shopping
                    </a>

                    <a href="/checkout"
                       class="rounded-lg bg-indigo-600 px-6 py-2
                              text-center font-semibold text-white hover:bg-indigo-700">
                        Checkout
                    </a>
                </div>

            @endif
        </div>
    </div>
</x-layout>

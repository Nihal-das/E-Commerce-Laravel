<x-layout>
    <x-slot:heading>Checkout</x-slot:heading>

    <div class="min-h-screen bg-gray-900 px-4 py-10 sm:px-6 lg:px-12">
        <div class="mx-auto max-w-4xl pt-28 space-y-8">

            {{-- ERROR MESSAGE --}}
            @if (session('error'))
                <div
                    class="rounded-lg bg-red-600 px-6 py-3
                           text-center text-white shadow-lg animate-bounce">
                    {{ session('error') }}
                </div>
            @endif

            <h2 class="text-2xl sm:text-3xl font-bold text-white">
                Review your order
            </h2>

            <!-- CART ITEMS -->
            <div class="space-y-4">
                @foreach ($cartItems as $cartItem)
                    <div
                        class="flex flex-col gap-4 rounded-xl
                               bg-gray-800 p-4
                               sm:flex-row sm:items-center sm:justify-between">

                        <div class="flex items-center gap-4">
                            <img
                                src="{{ asset('storage/' . $cartItem->item->image_path) }}"
                                class="h-14 w-14 rounded-lg object-cover sm:h-16 sm:w-16"
                                alt="{{ $cartItem->item->item_name }}"
                            />

                            <div>
                                <p class="font-semibold text-white">
                                    {{ $cartItem->item->item_name }}
                                </p>
                                <p class="text-sm text-gray-400">
                                    ₹{{ $cartItem->item->price }} × {{ $cartItem->quantity }}
                                </p>
                            </div>
                        </div>

                        <p class="text-right text-lg font-bold text-emerald-400">
                            ₹{{ $cartItem->item->price * $cartItem->quantity }}
                        </p>
                    </div>
                @endforeach
            </div>

            <!-- TOTAL -->
            <div
                class="flex flex-col gap-2 rounded-xl
                       bg-gray-800 p-6
                       sm:flex-row sm:items-center sm:justify-between">
                <span class="text-lg sm:text-xl font-semibold text-white">
                    Total Amount
                </span>
                <span class="text-2xl sm:text-3xl font-bold text-emerald-400">
                    ₹{{ $total }}
                </span>
            </div>

            <!-- ACTIONS -->
            <form method="POST" action="{{ route('checkout.store') }}">
                @csrf

                <div
                    class="flex flex-col gap-4
                           sm:flex-row sm:justify-end sm:gap-6">

                    <a href="{{ route('cart.show') }}"
                       class="rounded-lg bg-gray-700 px-6 py-2
                              text-center font-semibold text-white
                              hover:bg-gray-600">
                        Back to Cart
                    </a>

                    <button
                        type="submit"
                        class="rounded-lg bg-indigo-600 px-6 py-2
                               font-semibold text-white
                               hover:bg-indigo-700">
                        Place Order
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-layout>

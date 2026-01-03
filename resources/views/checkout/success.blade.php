<x-layout>
    <x-slot:heading>Order Successful</x-slot:heading>

    <div class="min-h-screen bg-gray-900 px-4 py-12 sm:px-6 lg:px-12">
        <div class="mx-auto max-w-xl pt-28 text-center">

            <div class="rounded-2xl bg-gray-800 p-6 sm:p-10 shadow-xl">

                <div class="mb-6 text-5xl sm:text-6xl">
                    ✅
                </div>

                <h2 class="mb-4 text-2xl sm:text-3xl font-bold text-white">
                    Order Placed Successfully
                </h2>

                <p class="mb-6 text-sm sm:text-base text-gray-400">
                    Thank you for your purchase. Your order has been confirmed.
                </p>

                <div class="mb-6 rounded-lg bg-gray-900 p-4">
                    <p class="text-xs sm:text-sm text-gray-400">
                        Order Number
                    </p>
                    <p class="text-lg sm:text-xl font-mono text-emerald-400 break-all">
                        {{ $order->order_number }}
                    </p>
                </div>

                <p class="mb-8 text-lg sm:text-xl font-semibold text-white">
                    Total Paid: ₹{{ $order->total_amount }}
                </p>

                <div
                    class="flex flex-col gap-4
                           sm:flex-row sm:justify-center sm:gap-6">

                    <a href="/"
                       class="rounded-lg bg-indigo-600 px-6 py-2
                              text-center font-semibold text-white
                              hover:bg-indigo-700">
                        Continue Shopping
                    </a>

                    <a href="{{ route('orders.show', $order) }}"
                       class="rounded-lg bg-gray-700 px-6 py-2
                              text-center font-semibold text-white
                              hover:bg-gray-600">
                        View Order
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-layout>

<x-layout>
    <x-slot:heading>Order Successful</x-slot:heading>

    <div class="bg-gray-900 min-h-screen py-20 pt-40">
        <div class="mx-auto max-w-xl text-center">

            <div class="rounded-2xl bg-gray-800 p-10 shadow-xl">

                <div class="mb-6 text-6xl">
                    ✅
                </div>

                <h2 class="text-3xl font-bold text-white mb-4">
                    Order Placed Successfully
                </h2>

                <p class="text-gray-400 mb-6">
                    Thank you for your purchase. Your order has been confirmed.
                </p>

                <div class="rounded-lg bg-gray-900 p-4 mb-6">
                    <p class="text-gray-400 text-sm">Order Number</p>
                    <p class="text-xl font-mono text-emerald-400">
                        {{ $order->order_number }}
                    </p>
                </div>

                <p class="text-lg font-semibold text-white mb-8">
                    Total Paid: ₹{{ $order->total_amount }}
                </p>

                <div class="flex justify-center gap-4">
                    <a href="/"
                       class="rounded-lg bg-indigo-600 px-6 py-2
                              font-semibold text-white hover:bg-indigo-700">
                        Continue Shopping
                    </a>

                    <a href="{{ route('orders.show', $order) }}"
                    class="rounded-lg bg-gray-700 px-6 py-2
                            font-semibold text-white hover:bg-gray-600">
                        View Order
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-layout>

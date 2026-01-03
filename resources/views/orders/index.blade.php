<x-layout>
    <x-slot:heading>My Orders</x-slot:heading>

    <div class="bg-gray-900 min-h-screen py-12 pt-28 sm:pt-36">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-0">

            @if ($orders->isEmpty())
                <div class="rounded-2xl bg-gray-800 p-8 sm:p-10 text-center shadow-lg">
                    <p class="text-lg sm:text-xl text-gray-400">
                        You haven’t placed any orders yet 📦
                    </p>

                    <a href="/"
                       class="mt-6 inline-block rounded-lg bg-indigo-600 px-6 py-3
                              text-sm sm:text-base font-semibold text-white
                              hover:bg-indigo-700 transition">
                        Start Shopping
                    </a>
                </div>
            @else

                <div class="space-y-4 sm:space-y-6">
                    @foreach ($orders as $order)
                        <a href="{{ route('orders.show', $order) }}"
                           class="block rounded-2xl bg-gray-800 p-5 sm:p-6
                                  shadow-lg transition hover:bg-gray-700">

                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                                <!-- LEFT -->
                                <div>
                                    <p class="text-xs sm:text-sm text-gray-400">
                                        Order Number
                                    </p>
                                    <p class="text-lg sm:text-xl font-mono text-emerald-400 break-all">
                                        {{ $order->order_number }}
                                    </p>

                                    <p class="mt-1 sm:mt-2 text-sm sm:text-base text-gray-300">
                                        Placed on {{ $order->created_at->format('d M Y') }}
                                    </p>
                                </div>

                                <!-- RIGHT -->
                                <div class="sm:text-right">
                                    <p class="text-xs sm:text-sm text-gray-400">Total</p>
                                    <p class="text-xl sm:text-2xl font-bold text-white">
                                        ₹{{ $order->total_amount }}
                                    </p>

                                    <span
                                        class="mt-2 inline-block rounded-full px-4 py-1
                                        text-xs sm:text-sm font-semibold
                                        {{ $order->status == 1
                                            ? 'bg-emerald-500/20 text-emerald-400'
                                            : 'bg-gray-500/20 text-gray-400' }}">
                                        {{ $order->status == 1 ? 'PAID' : 'PENDING' }}
                                    </span>
                                </div>

                            </div>

                        </a>
                    @endforeach
                </div>

            @endif
        </div>
    </div>
</x-layout>

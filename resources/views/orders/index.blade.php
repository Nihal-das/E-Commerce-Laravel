<x-layout>
    <x-slot:heading>My Orders</x-slot:heading>

    <div class="bg-gray-900 min-h-screen py-16 pt-40">
        <div class="mx-auto max-w-4xl">

            @if ($orders->isEmpty())
                <div class="rounded-2xl bg-gray-800 p-10 text-center shadow-lg">
                    <p class="text-xl text-gray-400">
                        You haven’t placed any orders yet 📦
                    </p>

                    <a href="/"
                       class="mt-6 inline-block rounded-lg bg-indigo-600 px-6 py-2
                              font-semibold text-white hover:bg-indigo-700">
                        Start Shopping
                    </a>
                </div>
            @else

                <div class="space-y-6">
                    @foreach ($orders as $order)
                        <a href="{{ route('orders.show', $order) }}"
                           class="block rounded-2xl bg-gray-800 p-6
                                  shadow-lg transition hover:bg-gray-700">

                            <div class="flex items-center justify-between">
                                <!-- LEFT -->
                                <div>
                                    <p class="text-sm text-gray-400">
                                        Order Number
                                    </p>
                                    <p class="text-xl font-mono text-emerald-400">
                                        {{ $order->order_number }}
                                    </p>

                                    <p class="mt-2 text-gray-300">
                                        Placed on
                                        {{ $order->created_at->format('d M Y') }}
                                    </p>
                                </div>

                                <!-- RIGHT -->
                                <div class="text-right">
                                    <p class="text-sm text-gray-400">Total</p>
                                    <p class="text-2xl font-bold text-white">
                                        ₹{{ $order->total_amount }}
                                    </p>

                                    <span
                                        class="mt-2 inline-block rounded-full px-4 py-1
                                        text-sm font-semibold
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

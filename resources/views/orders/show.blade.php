<x-layout>
    <x-slot:heading>
        Order #{{ $order->order_number }}
    </x-slot:heading>

    <div class="bg-gray-900 min-h-screen py-12 pt-28 sm:pt-36">
        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">

            <div class="rounded-2xl bg-gray-800 p-4 sm:p-6 shadow-lg">

                <h2 class="mb-6 text-xl sm:text-2xl font-bold text-white">
                    Order Items
                </h2>

                @foreach ($order->orderItems as $orderItem)
                    <div
                        class="mb-4 flex flex-col sm:flex-row sm:items-center sm:justify-between
                               gap-4 rounded-lg bg-gray-900 p-4">

                        <!-- LEFT : IMAGE + DETAILS -->
                        <div class="flex items-start gap-4">
                            <img
                                src="{{ asset('storage/' . $orderItem->item->image_path) }}"
                                alt="{{ $orderItem->item->item_name }}"
                                class="h-20 w-20 sm:h-24 sm:w-24 rounded-2xl object-cover"
                            />

                            <div>
                                <p class="text-base sm:text-lg font-semibold text-white">
                                    {{ $orderItem->item->item_name }}
                                </p>

                                <p class="mt-1 text-sm text-gray-400">
                                    Price: ₹{{ $orderItem->price }} × {{ $orderItem->quantity }}
                                </p>

                                <p class="text-sm text-gray-400">
                                    Returned: {{ $orderItem->returned_quantity }}
                                </p>
                            </div>
                        </div>

                        <!-- RIGHT : RETURN ACTION -->
                        @if ($orderItem->quantity > $orderItem->returned_quantity)
                            <form
                                action="{{ route('returns.store') }}"
                                method="POST"
                                class="flex items-center gap-2 self-end sm:self-auto">
                                @csrf

                                <input type="hidden" name="order_item_id" value="{{ $orderItem->id }}">

                                <input
                                    type="number"
                                    name="quantity"
                                    min="1"
                                    max="{{ $orderItem->quantity - $orderItem->returned_quantity }}"
                                    class="w-20 rounded bg-gray-700 px-2 py-1 text-sm text-white">

                                <button
                                    class="rounded bg-red-600 px-4 py-2 text-sm font-semibold text-white
                                           hover:bg-red-700 transition">
                                    Return
                                </button>
                            </form>
                        @endif

                    </div>
                @endforeach

                <div class="mt-6 border-t border-gray-700 pt-4 text-right">
                    <p class="text-lg sm:text-xl font-bold text-white">
                        Total: ₹{{ $order->total_amount }}
                    </p>
                </div>

            </div>
        </div>
    </div>
</x-layout>
<x-layout>
    <x-slot:heading>
        Order #{{ $order->order_number }}
    </x-slot:heading>

    <div class="bg-gray-900 min-h-screen py-16 pt-40 mx-auto min-w-screen px-80 ">

        <div class="rounded-2xl bg-gray-800 p-6 shadow-lg">

            <h2 class="mb-6 text-2xl font-bold text-white">
                Order Items
            </h2>

            @foreach ($order->orderItems as $orderItem)
                <div class="mb-4 flex items-center justify-between rounded-lg bg-gray-900 p-4">

                    <div>
                        <p class="text-lg font-semibold text-white">
                            {{ $orderItem->item->name }}
                        </p>

                        <p class="text-sm text-gray-400">
                            Price: ₹{{ $orderItem->price }} × {{ $orderItem->quantity }}
                        </p>

                        <p class="text-sm text-gray-400">
                            Returned: {{ $orderItem->returned_quantity }}
                        </p>
                    </div>

                    {{-- RETURN BUTTON --}}
                    @if ($orderItem->quantity > $orderItem->returned_quantity)
                        <form action="{{ route('returns.store') }}" method="POST" class="flex items-center gap-2">
                            @csrf

                            <input type="hidden" name="order_item_id" value="{{ $orderItem->id }}">

                            <input type="number"
                                   name="quantity"
                                   min="1"
                                   max="{{ $orderItem->quantity - $orderItem->returned_quantity }}"
                                   class="w-16 rounded bg-gray-700 px-2 py-1 text-white">

                            <button class="rounded bg-red-600 px-3 py-1 text-white hover:bg-red-700">
                                Return
                            </button>
                        </form>
                    @endif

                </div>
            @endforeach

            <div class="mt-6 border-t border-gray-700 pt-4 text-right">
                <p class="text-xl font-bold text-white">
                    Total: ₹{{ $order->total_amount }}
                </p>
            </div>

        </div>
    </div>
</x-layout>

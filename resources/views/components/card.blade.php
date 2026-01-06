@if (session('success'))
    <div
        id="success-message"
        class="mx-auto mb-8 w-fit rounded-lg
               bg-green-600 px-6 py-3
               text-center text-white shadow-lg
               animate-bounce">
        {{ session('success') }}
    </div>

    <script>
        setTimeout(() => {
            const el = document.getElementById('success-message');
            if (el) el.remove();
        }, 3000);
    </script>
@endif

<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div
        class="grid grid-cols-1 gap-8
               sm:grid-cols-2
               md:grid-cols-3
               lg:grid-cols-4">

        @foreach ($items as $item)
            <div
                class="flex flex-col overflow-hidden
                       rounded-2xl bg-gray-800
                       shadow-md transition-all duration-300
                       hover:-translate-y-1 hover:shadow-2xl">

                <a href="/item/{{ $item->id }}" class="block">
                    <img
                        src="{{ route('image.view', $item->id) }}"
                        alt="{{ $item->item_name }}"
                        class="h-48 w-full object-cover
                               transition-transform duration-300
                               hover:scale-105"
                    />

                    <div class="p-5 space-y-2">
                        <h3 class="text-lg font-semibold text-white truncate">
                            {{ $item->item_name }}
                        </h3>

                        <p class="text-xl font-bold text-emerald-400">
                            ₹{{ $item->price }}
                        </p>
                    </div>
                </a>

                <div class="mt-auto px-5 pb-5">
                    @if ($item->stock_quantity == 0)
                        <button
                            type="button"
                            disabled
                            class="w-full rounded-xl bg-gray-500 py-2
                                   font-semibold text-black
                                   cursor-not-allowed opacity-60">
                            Out of Stock
                        </button>
                    @else
                        <form action="{{ route('cart.add', $item->id) }}" method="POST">
                            @csrf
                            <button
                                type="submit"
                                class="w-full rounded-xl bg-emerald-500 py-2
                                       font-semibold text-black
                                       transition hover:bg-emerald-400">
                                Add to Cart
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    @if ($items->isEmpty())
        <p class="mt-16 text-center text-xl sm:text-2xl text-gray-400">
            No items found. Try a different keyword.
        </p>
    @endif
</div>

{{-- <div class="mt-12 flex justify-center">
    {{ $items->links() }}
</div> --}}

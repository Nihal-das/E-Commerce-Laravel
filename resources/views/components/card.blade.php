                    @if (session('success'))
            <div class="rounded-lg bg-green-600 px-6 py-3 text-white text-center shadow-lg animate-bounce">
                {{ session('success') }}
            </div>
     @endif
<div class="grid grid-cols-4 gap-6">
                @foreach ($items as $item)
               
                    <div
                        class="w-72 rounded-2xl bg-gray-800 shadow-lg
                               transition hover:-translate-y-1 hover:shadow-2xl">
                                <a href="/item/{{ $item->id }}">
                        <img
                            src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->image_path }}"
                            class="h-48 w-full rounded-t-2xl object-cover"
                        />

                        <div class="p-5">
                            <h3 class="text-lg font-semibold text-white">
                                {{ $item->item_name }}
                            </h3>

                            <p class="mt-2 text-xl font-bold text-emerald-400">
                                ₹{{ $item->price }}
                            </p>
                              </a>
                               @if ($item->stock_quantity == 0)

                                        <button
                                            type="button"
                                            disabled
                                            class="mt-4 w-full rounded-xl bg-gray-500 py-2
                                                font-semibold text-black cursor-not-allowed opacity-60">
                                            Out of Stock
                                        </button>
                                @else

                                <form action="{{ route('cart.add', $item->id) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="mt-4 w-full rounded-xl bg-emerald-500 py-2
                                            font-semibold text-black hover:bg-emerald-400">
                                        Add to Cart
                                    </button>
                                </form>
                                @endif

                        </div>
                    </div>
                  
                @endforeach

               
            </div>

            <div class=" flex justify-center ">
                 @if ($items->isEmpty())
    <p class=" mt-10 text-center text-3xl text-gray-400">
        No items found 😔 Try a different keyword.
    </p>
@endif
            </div>
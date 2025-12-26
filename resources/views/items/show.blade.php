<x-layout>
    <!-- Success Alert -->
    <div class="pt-20 flex justify-center bg-gradient-to-r from-black via-gray-900 to-black">
        @if (session('success'))
            <div class="rounded-lg bg-green-600 px-6 py-3 text-white text-center shadow-lg animate-bounce">
                {{ session('success') }}
            </div>
        @endif
    </div>

    <!-- Item Section -->
    <div class="flex flex-col lg:flex-row justify-center items-start gap-16 bg-gradient-to-r from-black via-gray-900 to-black min-h-screen px-12 py-16 pt-40  overflow-hidden">
        
        <!-- Item Image -->
        <div class="w-full h-[24rem] lg:w-[28rem] bg-gray-800 shadow-2xl rounded-2xl overflow-hidden my-auto">
            <img src="{{ asset('storage/' . $item->image_path) }}" 
                 alt="{{ $item->item_name }}" 
                 class="w-full h-[24rem] object-cover hover:scale-105 transition-transform duration-300" />
        </div>

        <!-- Item Details -->
        <div class="flex flex-col gap-6 max-w-xl">
            <h1 class="text-4xl font-bold text-white tracking-wide">
                {{ $item->item_name }}
            </h1>

            <p class="text-lg text-gray-300 font-semibold">
                Available Stock: 
                <span class="text-emerald-400">{{ $item->stock_quantity }}</span>
            </p>

            <p class="text-gray-300 leading-relaxed">
                <span class="text-2xl font-semibold text-white">Description:</span> 
                {{ $item->description }}
            </p>

            <p class="text-2xl font-bold text-emerald-400">
                Price: ₹{{ $item->price }}
            </p>

            <!-- Stock Button -->
            @if ($item->stock_quantity == 0)
                <button type="button" disabled
                    class="mt-4 w-full rounded-xl bg-gray-600 py-3 font-semibold text-white cursor-not-allowed opacity-70">
                    Out of Stock
                </button>
            @else
                <form action="{{ route('cart.add', $item->id) }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="mt-4 w-full rounded-xl bg-emerald-500 py-3 font-semibold text-black hover:bg-emerald-400 transition-colors duration-300">
                        Add to Cart
                    </button>
                </form>
            @endif
        </div>

        <!-- Admin Edit Button -->
        @if(auth()->user() && auth()->user()->role === 1)
            <div class="flex justify-center lg:justify-start">
                <a href="/item/edit/{{ $item->id }}"
                   class="mt-6 inline-block rounded-xl bg-emerald-500 px-6 py-3 font-semibold text-white shadow-md hover:border-2 hover:border-amber-200 hover:bg-emerald-400 hover:text-black transition-all duration-300">
                    Edit Item
                </a>
            </div>
        @endif
    </div>
</x-layout>
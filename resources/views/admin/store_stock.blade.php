<x-layout>


    <div class="bg-gray-900 min-h-screen py-16 px-8 pt-30">
        
        @if (session('success'))
            <div class="rounded-lg bg-green-600 px-6 py-3 text-white text-center shadow-lg animate-bounce">
                {{ session('success') }}
            </div>
        @endif
   

     <div class="overflow-x-auto rounded-xl border border-gray-700">
            <table class="w-full text-sm text-white">
                <thead class="bg-gray-800 text-gray-300">
                    <tr>
                        <th class="px-6 py-4 text-left">Item</th>
                        <th class="px-6 py-4 text-center">Stock</th>
                       
                        <th class="px-6 py-4 text-center">Add Stock</th>
                        
                    </tr>
                </thead>

                <tbody>
                    @foreach ($available_stocks as $stock)
                        <tr class="border-t border-gray-700 hover:bg-gray-800/60 transition">
                            <td class="px-6 py-4 font-medium">
                                {{ $stock->item_name }}
                            </td>

                            <td class="px-6 py-4 text-center">
                               {{ $stock->stock_quantity  }}
                            </td>


                           <td class="px-6 py-4 text-center">
                            <form method="POST"
                                action="{{ route('admin.store', $stock) }}"
                                class="flex items-center justify-center gap-3">
                                @csrf

                                <input
                                    type="number"
                                    name="add_quantity"
                                    min="1"
                                    required
                                    class="w-24 rounded-lg bg-gray-900 border border-gray-600
                                        px-3 py-1 text-white focus:border-indigo-500 focus:ring-1
                                        focus:ring-indigo-500"
                                >

                                <button
                                    type="submit"
                                    class="rounded-lg bg-emerald-600 px-4 py-1
                                        font-semibold text-black hover:bg-emerald-500 transition">
                                    Add
                                </button>
                            </form>
                        </td>
                                                </tr>
                    @endforeach

                </tbody>
            </table>
            </div>
    </div>

</x-layout>
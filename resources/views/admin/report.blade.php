<x-layout>
    <x-slot:heading>Transactions Report</x-slot:heading>

    <div class="bg-gray-900 min-h-screen py-16 px-8 pt-30">

        <!-- FILTER BAR -->
        <form method="GET"
              action="{{ route('admin.reports') }}"
              class="mb-10 flex flex-wrap items-end gap-6">

            <div class="flex flex-col">
                <label class="mb-1 text-sm text-gray-400">Start Date</label>
                <input type="date"
                       name="start_date"
                       value="{{ request('start_date') }}"
                       class="rounded-lg bg-gray-800 px-4 py-2 text-white
                              border border-gray-700 focus:outline-none
                              focus:ring-2 focus:ring-indigo-500">
            </div>

            <div class="flex flex-col">
                <label class="mb-1 text-sm text-gray-400">End Date</label>
                <input type="date"
                       name="end_date"
                       value="{{ request('end_date') }}"
                       class="rounded-lg bg-gray-800 px-4 py-2 text-white
                              border border-gray-700 focus:outline-none
                              focus:ring-2 focus:ring-indigo-500">
            </div>

            <button type="submit"
                    class="h-11 rounded-lg bg-indigo-600 px-6
                           font-semibold text-white
                           hover:bg-indigo-500 transition">
                Apply Filter
            </button>
        </form>

        <!-- SUMMARY CARDS -->
        <div class="mb-10 grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="rounded-xl bg-gray-800 p-6">
                <p class="text-sm text-gray-400">Total Stock</p>
                <p class="mt-2 text-3xl font-bold text-white">
                    {{ $items->sum('stock_quantity') }}
                </p>
            </div>

            <div class="rounded-xl bg-gray-800 p-6">
                <p class="text-sm text-gray-400">Total Sold</p>
                <p class="mt-2 text-3xl font-bold text-emerald-400">
                    {{ $items->sum(fn($i) => $i->orderItems->sum('quantity')) }}
                </p>
            </div>

            <div class="rounded-xl bg-gray-800 p-6">
                <p class="text-sm text-gray-400">Total Returned</p>
                <p class="mt-2 text-3xl font-bold text-yellow-400">
                    {{ $items->sum(fn($i) => $i->orderItems->sum('returned_quantity')) }}
                </p>
            </div>
        </div>

        <!-- TABLE -->
        <div class="overflow-x-auto rounded-xl border border-gray-700">
            <table class="w-full text-sm text-white">
                <thead class="bg-gray-800 text-gray-300">
                    <tr>
                        <th class="px-6 py-4 text-left">Item</th>
                        <th class="px-6 py-4 text-center">Stock</th>
                        <th class="px-6 py-4 text-center">Sold</th>
                        <th class="px-6 py-4 text-center">Returned</th>
                        
                    </tr>
                </thead>

                <tbody>
                    @foreach($items as $item)
                        <tr class="border-t border-gray-700 hover:bg-gray-800/60 transition">
                            <td class="px-6 py-4 font-medium">
                                {{ $item->item_name }}
                            </td>

                            <td class="px-6 py-4 text-center">
                                {{ $item->stock_quantity }}
                            </td>

                            <td class="px-6 py-4 text-center text-emerald-400 font-semibold">
                                {{ $item->orderItems->sum('quantity') }}
                            </td>

                            <td class="px-6 py-4 text-center text-yellow-400 font-semibold">
                                {{ $item->orderItems->sum('returned_quantity') ?? 0 }}
                            </td>

                           
                        </tr>
                    @endforeach

                    @if($items->isEmpty())
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-gray-400">
                                No transactions found for this date range.
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

    </div>
</x-layout>

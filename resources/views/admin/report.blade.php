<x-layout>
    <x-slot:heading>Transactions Report</x-slot:heading>

    <div class="min-h-screen bg-gray-900 px-4 py-10 sm:px-6 lg:px-12">
        <div class="mx-auto max-w-7xl pt-28">

            <!-- FILTER BAR -->
            <form method="GET"
                  action="{{ route('admin.reports') }}"
                  class="mb-10 flex flex-col gap-4 sm:flex-row sm:items-end sm:gap-6">

                <div class="flex flex-col w-full sm:w-auto">
                    <label class="mb-1 text-xs font-medium text-gray-400">
                        Start Date
                    </label>
                    <input type="date"
                           name="start_date"
                           value="{{ request('start_date') }}"
                           class="rounded-lg bg-gray-800 px-4 py-2 text-white
                                  border border-gray-700 focus:outline-none
                                  focus:ring-2 focus:ring-indigo-500">
                </div>

                <div class="flex flex-col w-full sm:w-auto">
                    <label class="mb-1 text-xs font-medium text-gray-400">
                        End Date
                    </label>
                    <input type="date"
                           name="end_date"
                           value="{{ request('end_date') }}"
                           class="rounded-lg bg-gray-800 px-4 py-2 text-white
                                  border border-gray-700 focus:outline-none
                                  focus:ring-2 focus:ring-indigo-500">
                </div>

                <button type="submit"
                        class="w-full sm:w-auto h-11 rounded-lg
                               bg-indigo-600 px-8 font-semibold text-white
                               hover:bg-indigo-500 transition">
                    Apply Filter
                </button>
            </form>

            <!-- SUMMARY CARDS -->
            <div class="mb-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="rounded-2xl bg-gray-800 p-6">
                    <p class="text-sm text-gray-400">Total Stock</p>
                    <p class="mt-3 text-3xl font-bold text-white">
                        {{ $items->sum('stock_quantity') }}
                    </p>
                </div>

                <div class="rounded-2xl bg-gray-800 p-6">
                    <p class="text-sm text-gray-400">Total Sold</p>
                    <p class="mt-3 text-3xl font-bold text-emerald-400">
                        {{ $items->sum(fn($i) => $i->orderItems->sum('quantity')) }}
                    </p>
                </div>

                <div class="rounded-2xl bg-gray-800 p-6">
                    <p class="text-sm text-gray-400">Total Returned</p>
                    <p class="mt-3 text-3xl font-bold text-yellow-400">
                        {{ $items->sum(fn($i) => $i->orderItems->sum('returned_quantity')) }}
                    </p>
                </div>
            </div>

            <!-- TABLE -->
            <div class="overflow-x-auto rounded-2xl border border-gray-700 bg-gray-900">
                <table class="min-w-full text-sm text-white">
                    <thead class="bg-gray-800 text-gray-300">
                        <tr>
                            <th class="px-4 py-4 text-left sm:px-6">Item</th>
                            <th class="px-4 py-4 text-center sm:px-6">Stock</th>
                            <th class="px-4 py-4 text-center sm:px-6">Sold</th>
                            <th class="px-4 py-4 text-center sm:px-6">Returned</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($items as $item)
                            <tr class="border-t border-gray-700 hover:bg-gray-800/60 transition">
                                <td class="px-4 py-4 font-medium sm:px-6">
                                    {{ $item->item_name }}
                                </td>

                                <td class="px-4 py-4 text-center sm:px-6">
                                    {{ $item->stock_quantity }}
                                </td>

                                <td class="px-4 py-4 text-center text-emerald-400 font-semibold sm:px-6">
                                    {{ $item->orderItems->sum('quantity') }}
                                </td>

                                <td class="px-4 py-4 text-center text-yellow-400 font-semibold sm:px-6">
                                    {{ $item->orderItems->sum('returned_quantity') ?? 0 }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4"
                                    class="px-6 py-12 text-center text-gray-400">
                                    No transactions found for this date range.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-layout>

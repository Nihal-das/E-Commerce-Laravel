<x-layout>
    <div class="min-h-screen bg-gray-900 px-4 py-10 sm:px-6 lg:px-12">
        <div class="mx-auto max-w-7xl pt-28">

            {{-- SUCCESS MESSAGE --}}
            @if (session('success'))
                <div
                    class="mb-6 rounded-lg bg-green-600 px-6 py-3
                           text-center text-white shadow-lg animate-bounce">
                    {{ session('success') }}
                </div>
            @endif

            {{-- ACTION BUTTONS --}}
            <div
                class="mb-10 flex flex-col gap-4
                       sm:flex-row sm:items-center sm:gap-6">

                <a href="{{ route('items.download_excel') }}"
                   class="w-full sm:w-auto text-center
                          rounded-md bg-green-600 px-5 py-2
                          font-semibold text-white shadow-md
                          transition hover:bg-green-700">
                    Download Excel
                </a>

                <a href="{{ route('items.download_pdf') }}"
                   class="w-full sm:w-auto text-center
                          rounded-md bg-green-600 px-5 py-2
                          font-semibold text-white shadow-md
                          transition hover:bg-green-700">
                    Download PDF
                </a>
            </div>

            {{-- TABLE --}}
            <div class="overflow-x-auto rounded-2xl border border-gray-700 bg-gray-900">
                <table class="min-w-full text-sm text-white">
                    <thead class="bg-gray-800 text-gray-300">
                        <tr>
                            <th class="px-4 py-4 text-left sm:px-6">Item</th>
                            <th class="px-4 py-4 text-center sm:px-6">Stock</th>
                            <th class="px-4 py-4 text-center sm:px-6">Add Stock</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($available_stocks as $stock)
                            <tr
                                class="border-t border-gray-700
                                       transition hover:bg-gray-800/60">

                                <td class="px-4 py-4 font-medium sm:px-6">
                                    {{ $stock->item_name }}
                                </td>

                                <td class="px-4 py-4 text-center sm:px-6">
                                    {{ $stock->stock_quantity }}
                                </td>

                                <td class="px-4 py-4 sm:px-6">
                                    <form method="POST"
                                          action="{{ route('admin.store', $stock) }}"
                                          class="flex flex-wrap items-center
                                                 justify-center gap-3">
                                        @csrf

                                        <input
                                            type="number"
                                            name="add_quantity"
                                            min="1"
                                            required
                                            class="w-24 rounded-lg bg-gray-900
                                                   border border-gray-600 px-3 py-1
                                                   text-white focus:border-indigo-500
                                                   focus:ring-1 focus:ring-indigo-500"
                                        >

                                        <button
                                            type="submit"
                                            class="rounded-lg bg-emerald-600
                                                   px-4 py-1 font-semibold text-black
                                                   transition hover:bg-emerald-500">
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
    </div>
</x-layout>
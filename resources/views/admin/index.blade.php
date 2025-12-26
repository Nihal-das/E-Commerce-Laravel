<x-layout>
    <div class="min-h-screen bg-gray-900 py-16 pt-40">
        <div class="flex justify-center space-x-11">
            <a
                href="{{ route('admin.reports') }}"
                class="mt-6 inline-block rounded-lg bg-indigo-600 px-6 py-2 font-semibold text-white hover:bg-indigo-700"
                >Reports</a
            >

            <a
                href="{{ route('admin.show_stock') }}"
                class="mt-6 inline-block rounded-lg bg-indigo-600 px-6 py-2 font-semibold text-white hover:bg-indigo-700"
                >Add Stock</a
            >
        </div>
    </div>
</x-layout>

<x-layout>
    <div class="min-h-screen bg-gray-900 flex items-center justify-center px-4">
        <div
            class="w-full max-w-3xl pt-32 flex flex-col gap-6 sm:flex-row sm:justify-center sm:gap-10"
        >
            <a
                href="{{ route('admin.reports') }}"
                class="w-full sm:w-auto text-center rounded-xl bg-indigo-600 px-8 py-3 text-base font-semibold text-white transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-400"
            >
                Reports
            </a>

            <a
                href="{{ route('admin.show_stock') }}"
                class="w-full sm:w-auto text-center rounded-xl bg-indigo-600 px-8 py-3 text-base font-semibold text-white transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-400"
            >
                Add Stock
            </a>

            <a
                href="{{ route('admin.users_view') }}"
                class="w-full sm:w-auto text-center rounded-xl bg-indigo-600 px-8 py-3 text-base font-semibold text-white transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-400"
            >
                View All Users
            </a>
        </div>
    </div>
</x-layout>

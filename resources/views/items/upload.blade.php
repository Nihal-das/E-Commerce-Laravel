<x-layout>
    <x-slot name="heading">
        Upload CSV File
    </x-slot>

    <div class="bg-gray-900 min-h-screen flex items-center justify-center">
        <section class="relative isolate px-6 lg:px-8 w-full max-w-xl">

            <!-- HERO BLUR -->
            <div aria-hidden="true"
                class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl">
                <div
                    class="relative left-1/2 aspect-[1155/678] w-[36rem]
                    -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr
                    from-[#ff80b5] to-[#9089fc] opacity-30">
                </div>
            </div>

            <!-- CARD -->
            <div class="relative z-50 rounded-2xl bg-gray-800/80 p-8 shadow-2xl backdrop-blur">
                <h2 class="text-2xl font-bold text-white text-center mb-6">
                    Upload Items CSV
                </h2>

                <!-- ERRORS -->
                @if ($errors->any())
                    <div class="mb-4 rounded-lg border border-red-500/40 bg-red-500/10 p-4 text-red-400">
                        <ul class="list-disc list-inside text-sm space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                 @if (session('success'))
                <div class="rounded-lg bg-green-600 px-6 py-3 text-white text-center shadow-lg animate-bounce">
                    {{ session('success') }}
                </div>
                @endif

                <!-- FORM -->
                <form action="{{ route('items.upload') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <!-- FILE INPUT -->
                    <label
                        class="flex cursor-pointer flex-col items-center justify-center rounded-xl border-2 border-dashed
                               border-gray-600 p-6 text-gray-300 transition hover:border-indigo-400 hover:text-indigo-300">
                        <svg class="mb-3 h-10 w-10 text-indigo-400" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                        </svg>

                        <span class="text-sm font-medium">
                            Click to upload or drag & drop
                        </span>
                        <span class="mt-1 text-xs text-gray-400">
                            CSV files only
                        </span>

                        <input
                            type="file"
                            id="csv_file"
                            name="csv_file"
                            accept=".csv"
                            class="hidden"
                            required
                        >
                    </label>

                    <!-- PREVIEW -->
                    <div id="csv-preview" class="hidden mt-6 rounded-lg bg-gray-700/50 p-4 text-gray-200">
                        <h3 class="text-lg font-semibold mb-3">Preview</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full text-sm text-left border border-gray-600 rounded-lg">
                                <thead class="bg-gray-600 text-gray-100"></thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>

                    <!-- BUTTON -->
                    <button
                        type="submit"
                        class="w-full rounded-xl bg-indigo-500 py-3 text-lg font-semibold text-white
                               transition hover:bg-indigo-400 focus:outline-none focus:ring-2
                               focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-900">
                        Upload CSV 🚀
                    </button>
                </form>
            </div>
        </section>
    </div>

    <!-- SCRIPT -->
    <script>
        document.getElementById('csv_file').addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function (e) {
                const text = e.target.result;
                const rows = text.trim().split('\n').map(r => r.split(','));

                const preview = document.getElementById('csv-preview');
                const thead = preview.querySelector('thead');
                const tbody = preview.querySelector('tbody');

                // Clear old content
                thead.innerHTML = '';
                tbody.innerHTML = '';

                // Build header
                const headerRow = document.createElement('tr');
                rows[0].forEach(col => {
                    const th = document.createElement('th');
                    th.className = 'px-3 py-2 border border-gray-600';
                    th.textContent = col;
                    headerRow.appendChild(th);
                });
                thead.appendChild(headerRow);

                // Build body
                rows.slice(1).forEach(row => {
                    const tr = document.createElement('tr');
                    row.forEach(col => {
                        const td = document.createElement('td');
                        td.className = 'px-3 py-2 border border-gray-600';
                        td.textContent = col;
                        tr.appendChild(td);
                    });
                    tbody.appendChild(tr);
                });

                preview.classList.remove('hidden');
            };
            reader.readAsText(file);
        });
    </script>
</x-layout>
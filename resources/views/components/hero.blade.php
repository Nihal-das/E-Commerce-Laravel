<x-layout>
    <div class="bg-gray-900 pb-40">
        <!-- HERO SECTION -->
        <section class="relative isolate px-4 pt-14 sm:px-6 lg:px-8">
            <!-- TOP BLUR -->
            <div aria-hidden="true"
                 class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80">
                <div
                    class="relative left-1/2 aspect-[1155/678] w-[36rem]
                           -translate-x-1/2 rotate-30
                           bg-gradient-to-tr from-[#ff80b5] to-[#9089fc]
                           opacity-30 sm:w-[72rem]">
                </div>
            </div>

            <!-- HERO CONTENT -->
            <div class="mx-auto max-w-3xl py-20 text-center sm:py-28 lg:py-40">
                <h1 class="font-serif text-4xl font-semibold text-white sm:text-6xl mb-2">
                    Hello, {{ $user->name }}
                </h1>

                <h2 class="font-serif text-4xl font-semibold text-white sm:text-6xl">
                    Let's fill your basket
                </h2>

                <form method="GET" action="{{ route('items.show') }}" class="mt-10">
                    <input
                        type="text"
                        name="search"
                        autocomplete="search"
                        value="{{ request('search') }}"
                        placeholder="Search items..."
                        class="w-full rounded-2xl border-2 border-white
                               bg-transparent px-5 py-3
                               text-lg sm:text-xl text-white
                               focus:outline-none focus:ring-2
                               focus:ring-indigo-500"
                    />
                </form>
            </div>

            <!-- BOTTOM BLUR -->
            <div aria-hidden="true"
                 class="absolute inset-x-0 top-full -z-10 transform-gpu overflow-hidden blur-3xl">
                <div
                    class="relative left-1/2 aspect-[1155/678] w-[36rem]
                           -translate-x-1/2
                           bg-gradient-to-tr from-[#ff80b5] to-[#9089fc]
                           opacity-30 sm:w-[72rem]">
                </div>
            </div>
        </section>

        <!-- ITEMS GRID -->
        <section class="relative z-20 mt-16 px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-7xl">
                <x-card :items="$items" />
            </div>
        </section>
    </div>
</x-layout>

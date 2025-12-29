<x-layout>
    <div class="bg-gray-900 pb-[17.2rem]">
        <!-- HERO SECTION -->
        <section class="relative isolate px-6 pt-14 lg:px-8">
            <!-- TOP BLUR -->
            <div aria-hidden="true" class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80">
                <div
                    class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36rem] -translate-x-1/2 rotate-30 bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72rem]"
                ></div>
            </div>

            <!-- HERO CONTENT -->
            <div class="mx-auto max-w-3xl py-24 text-center sm:py-32 lg:py-48">
                <h1 class="font-serif text-5xl font-semibold text-white sm:text-7xl mb-2">Hello, {{ $user->name }}</h1>
                <h1 class="font-serif text-5xl font-semibold text-white sm:text-7xl">Let's fill your basket</h1>
                <form method="GET" action="{{ route('items.show') }}" autocomplete="on">
                    
                    <input
                        type="text"
                         name="search"
                          autocomplete="search"
                        value="{{ request('search') }}"
                        placeholder="Search"
                        class="mt-10 w-full rounded-2xl border-2 border-white bg-transparent px-5 py-3 text-2xl text-white focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                    />
                </form>
            </div>

            <!-- BOTTOM BLUR -->
            <div aria-hidden="true" class="absolute inset-x-0 top-full -z-10 transform-gpu overflow-hidden blur-3xl">
                <div
                    class="relative left-[calc(50%+3rem)] aspect-[1155/678] w-[36rem] -translate-x-1/2 bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%+36rem)] sm:w-[72rem]"
                ></div>
            </div>
        </section>

        <!-- CATEGORIES -->
        <!-- <section class="relative z-20 -mt-20 ml-48">
            <x-categories />
        </section> -->

        <!-- ITEMS GRID -->
        <section class="relative z-20 mt-10 ml-20">
            <x-card :items="$items" />
        </section>
    </div>
</x-layout>

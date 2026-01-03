<x-layout>
    <div class="bg-gray-900 min-h-screen">
        <!-- HERO SECTION -->
        <section class="relative isolate px-4 pt-16 sm:px-6 lg:px-8">

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

            <!-- CONTENT -->
            <div class="mx-auto max-w-7xl pt-20 pb-24">
                <div
                    class="grid grid-cols-1 gap-6
                           sm:grid-cols-2
                           lg:grid-cols-3">

                    @foreach ($users as $user)
                        <div
                            class="rounded-2xl bg-gray-800 p-6 shadow-lg
                                   transition-all duration-300
                                   hover:-translate-y-1 hover:shadow-2xl">

                            <h3 class="text-lg font-semibold text-white">
                                {{ $user->name }}
                            </h3>

                            <p class="mt-2 break-words text-sm text-emerald-400">
                                {{ $user->email }}
                            </p>

                            <p class="mt-1 text-sm text-gray-300">
                                {{ $user->phone_number }}
                            </p>
                        </div>
                    @endforeach

                </div>
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
    </div>
</x-layout>

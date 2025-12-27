<x-layout>
    <div class="bg-gray-900 pb-[40rem]">
        <!-- HERO SECTION -->
        <section class="relative isolate px-6 pt-14 lg:px-8">
            <!-- TOP BLUR -->
            <div aria-hidden="true" class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80">
                <div
                    class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36rem] -translate-x-1/2 rotate-30 bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72rem]"
                ></div>
            </div>

            <!-- HERO CONTENT -->
            <div class="overflow-y-hidden">
               <div class="grid grid-cols-3 gap-5 p-10 mt-30 justify-center">
                @foreach ($users as $user)
               
                    <div
                        class="w-80 rounded-2xl bg-gray-800 shadow-lg
                               transition hover:-translate-y-1 hover:shadow-2xl ">
            
                        
                        <div class="p-5">
                            <h3 class="text-lg font-semibold text-white">
                                {{ $user->name }}
                            </h3>

                            <p class="mt-2 text-xl font-bold text-emerald-400">
                                {{ $user->email }}
                            </p>
                            <p class="mt-2 text-xl font-bold text-emerald-400">
                                {{ $user->phone_number }}
                            </p>
                              </a> 

                        </div>
                    </div>
                  
                @endforeach

               
            </div>
            </div>

            <!-- BOTTOM BLUR -->
            <div aria-hidden="true" class="absolute inset-x-0 top-full -z-10 transform-gpu overflow-hidden blur-3xl">
                <div
                    class="relative left-[calc(50%+3rem)] aspect-[1155/678] w-[36rem] -translate-x-1/2 bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%+36rem)] sm:w-[72rem]"
                ></div>
            </div>
        </section>

       
    </div>
</x-layout>

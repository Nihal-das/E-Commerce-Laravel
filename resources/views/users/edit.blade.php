<x-layout>
    <x-slot:heading>Update Profile</x-slot:heading>

    <div class="bg-gray-900 pb-48">
        <section class="relative isolate px-6 pt-14 lg:px-8">

            <!-- HERO BLUR -->
            <div aria-hidden="true"
                 class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80">
                <div
                    class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36rem]
                           -translate-x-1/2 rotate-30 bg-gradient-to-tr
                           from-[#ff80b5] to-[#9089fc] opacity-30
                           sm:left-[calc(50%-30rem)] sm:w-[72rem]">
                </div>
            </div>
            
           @if ($errors->any())
    <div class="mt-2 text-red-400">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
            <!-- FORM -->
            <div class="mx-auto max-w-lg py-24 sm:py-32 lg:py-40 text-center">
                <form method="post"
                     action="/profile/{{ $user->id }}"
                      enctype="multipart/form-data"
                      class="space-y-10">
                      @method('PATCH')
                    @csrf
                    

                    @if (session('success'))
                        <div class="rounded-lg bg-green-600 px-4 py-3 text-white">
                            {{ session('success') }}
                        </div>
                    @endif

                    <h2 class="text-5xl font-semibold text-white">
                        Update Profile
                    </h2>

                    <!-- ITEM NAME -->
                    <div class="text-left">
                        <label class="text-xl font-medium text-white">Name</label>
                        <input
                            type="text"
                            name="name"
                            value="{{ $user->name }}"
                            class="mt-2 w-full rounded-md bg-white/5 px-4 py-2 text-white
                                   focus:outline-2 focus:outline-indigo-500"
                        />
                        @error('name')
                            <p class="mt-2 text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="text-left">
                        <label class="text-xl font-medium text-white">Phone number</label>
                        <input
                            type="number"
                            name="phone_number"
                            value="{{ $user->phone_number }}"
                            class="mt-2 w-full rounded-md bg-white/5 px-4 py-2 text-white
                                   focus:outline-2 focus:outline-indigo-500"
                        />
                        @error('phone_number')
                            <p class="mt-2 text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Address -->
                    <div class="text-left">
                        <label class="text-xl font-medium text-white">Address</label>
                        <textarea
                            name="address"
                            rows="4"
                           
                            class="mt-2 w-full rounded-md bg-white/5 px-4 py-2 text-white
                                   focus:outline-2 focus:outline-indigo-500"
                        >{{ $user->address }}</textarea>
                    </div>

                    <!-- ACTIONS -->
                    <div class="flex justify-end gap-6 pt-6">
                        <a href="/"
                           class="rounded-md bg-indigo-600 px-6 py-2
                                   font-semibold text-white hover:text-black   hover:bg-red-300">
                            Cancel
                        </a>

                        <button
                            type="submit"
                            class="rounded-md bg-indigo-600 px-6 py-2
                                   font-semibold text-white hover:bg-green-400">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </section>
    </div>

 
</x-layout>

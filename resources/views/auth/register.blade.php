<x-layout>
    <x-slot:heading>
        Register
    </x-slot:heading>
    <div class="flex min-h-full flex-col justify-center bg-black px-6 pb-11
     lg:px-8">

        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-white">Register</h2>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-sm">
            <form action="/register" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label for="name" class="block text-sm/6 font-medium text-gray-100">Name</label>
                    @error('name')
                            <p class="mt-2 text-red-400">{{ $message }}</p>
                        @enderror
                    <div class="mt-2">
                        <input
                            id="name"
                            type="name"
                            name="name"
                            required
                            class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6"
                        />
                    </div>
                </div>

                <div>
                    <label for="email" class="block text-sm/6 font-medium text-gray-100">Email address</label>
                    @error('email')
                            <p class="mt-2 text-red-400">{{ $message }}</p>
                        @enderror
                    <div class="mt-2">
                        <input
                            id="email"
                            type="email"
                            name="email"
                            required
                            class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6"
                        />
                    </div>
                </div>

                  <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm/6 font-medium text-gray-100">Password</label>
                        @error('password')
                            <p class="mt-2 text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mt-2">
                        <input
                            id="password"
                            type="password"
                            name="password"
                            required
                            class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6"
                        />
                    </div>
                </div>

                  <div>
                    <div class="flex items-center justify-between">
                        <label for="phone_number" class="block text-sm/6 font-medium text-gray-100">Phone number</label>
                        @error('phone_number')
                            <p class="mt-2 text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mt-2">
                        <input
                            id="phone_number"
                            type="number"
                            name="phone_number"
                            required
                            class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6"
                        />
                    </div>
                </div>

                <div>
                    <label for="address" class="block text-sm/6 font-medium text-gray-100">Address</label>
                    @error('address')
                            <p class="mt-2 text-red-400">{{ $message }}</p>
                        @enderror
                    <div class="mt-2">
                        <textarea
                            id="address"
                            name="address"
                            rows="4"
                            class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6"
                            placeholder="Please enter your address"
                        ></textarea>
                    </div>
                </div>

              

                <div>
                    <button
                        type="submit"
                        class="flex w-full justify-center rounded-md bg-indigo-500 px-3 py-1.5 text-sm/6 font-semibold text-white hover:bg-indigo-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500"
                    >
                        Sign in
                    </button>
                </div>
            </form>

            <p class="mt-8 text-center text-sm/6 text-gray-400">
                Already a member?
                <a href="/login" class="font-semibold text-indigo-400 hover:text-indigo-300">Log in</a>
            </p>
        </div>
    </div>
</x-layout>

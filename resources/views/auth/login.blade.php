<x-layout>
 <x-slot:heading>
       Login
    </x-slot:heading>
<div class=" bg-black flex min-h-full flex-col  justify-center px-6 py-10 pb-64  lg:px-8">
  <div class="sm:mx-auto sm:w-full sm:max-w-sm mt-20">
    <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-white">Log in to your account</h2>
  </div>

  <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
    <form action="/login" method="POST" class="space-y-6">
      @csrf
      <div>
        <label for="email" class="block text-sm/6 font-medium text-gray-100">Email address</label>
        <div class="mt-2">
          <input id="email" type="email" name="email" required  value="{{ old('email', $email ?? '') }}" class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
        </div>
        @error('email')
          {{ $message }}          
        @enderror
      </div>

      <div>
        <div class="flex items-center justify-between">
          <label for="password" class="block text-sm/6 font-medium text-gray-100">Password</label>
         
        </div>
        <div class="mt-2">
          <input id="password" type="password" name="password" required  class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
        </div>
         @error('password')
          {{ $message }}          
        @enderror
      </div>

      <div>
        <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-500 px-3 py-1.5 text-sm/6 font-semibold text-white hover:bg-indigo-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Log in</button>
      </div>
    </form>

    <p class="mt-10 text-center text-sm/6 text-gray-400">
      Not a member?
      <a href="/register" class="font-semibold text-indigo-400 hover:text-indigo-300">Register</a>
    </p>
  </div>
</div>
</x-layout>
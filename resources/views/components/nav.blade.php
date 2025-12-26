<div class="relative">
    <header class=" fixed inset-x-0 top-0 z-50 shadow-lg rounded-b-xl">
        <nav aria-label="Global" class="flex items-center justify-between p-6 lg:px-8">
            <div class="flex lg:flex-1">
                <a href="https://nihal-das.vercel.app/" class="-m-2 p-1.5 -mt-4">
                    <span class="sr-only">Your Company</span>
                    <img class="h-10 rounded-xl"  src="https://raw.githubusercontent.com/Nihal-das/Assets/main/Nihal_das.png" alt="Nihal Das">
                </a>
            </div>
            <div class="flex lg:hidden">
                <button
                    type="button"
                    command="show-modal"
                    commandfor="mobile-menu"
                    class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-200"
                >
                    <span class="sr-only">Open main menu</span>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6">
                        <path d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
            <div class="hidden lg:flex lg:gap-x-12">
                <a href="/" class="text-sm/6 font-semibold text-white {{ request()->is('/') ? 'px-4 py-2 -mt-2 bg-black rounded-2xl' : ''}}">Home</a>
                <a href="/uploads" class="text-sm/6 font-semibold text-white {{ request()->is('uploads') ? 'px-4 py-2 -mt-2 bg-black rounded-2xl' : ''}}">Upload</a>
                <a href="" class="text-sm/6 font-semibold text-white {{ request()->is('#') ? 'px-4 py-2 -mt-2 bg-black rounded-2xl' : ''}}">Marketplace</a>
                
                {{-- <h1 class="font-serif text-5xl font-semibold tracking-tight text-balance text-white">Shopping Spree</h1> --}}
            </div>
            <div class="hidden lg:flex space-x-6 lg:flex-1 lg:justify-end">
                @guest
                <a href="/login" class="text-sm/6 font-semibold text-white {{ request()->is('login') ? 'px-4 py-4 bg-black' : ''}}">Log in <span aria-hidden="true">&rarr;</span></a>
                <a href="/register" class="text-sm/6 font-semibold text-white">Register<span aria-hidden="true">&rarr;</span></a>
                 @endguest

                 @auth

                 <div>
    <a href="{{ route('cart.show') }}" class="z-52 {{ request()->is('/cart') ? 'px-4 py-2 -mt-2 bg-black rounded-2xl' : ''}}"><img src="{{ asset('storage/' . 'items/trolley.png') }}" alt="Cart Image" class="h-10 w-10 mb-3"></a>
    @if (! $cartCount == 0)
        <div class="absolute top-4 right-22 flex items-center justify-center w-6 h-6 bg-red-700 text-white text-xs font-bold rounded-full border border-amber-50">
    {{ $cartCount }}
</div>
    @endif

</div>


<el-dropdown class="inline-block">
  <button>
    <a  class=" {{ request()->is('profile') ? 'px-4 py-2 -mt-2 bg-black rounded-2xl' : ''}}"><img src="{{ asset('storage/' . 'items/user.png') }}" alt="profile Image" class="h-10 w-10 mb-2 bg-amber-50 rounded-full"></a>
  </button>

  <el-menu anchor="bottom end" popover class="w-56 origin-top-right rounded-md bg-gray-800 outline-1 -outline-offset-1 outline-white/10 transition transition-discrete [--anchor-gap:--spacing(2)] data-closed:scale-95 data-closed:transform data-closed:opacity-0 data-enter:duration-100 data-enter:ease-out data-leave:duration-75 data-leave:ease-in">
    <div class="py-1">
      <a href="/profile/{{ auth()->user()->id }}" class="block px-4 py-2 text-sm text-gray-300 focus:bg-white/5 focus:text-white focus:outline-hidden">Profile</a>


       @if(auth()->user() && auth()->user()->role === 1)
       <a href="{{ route('items.create') }}" class="block px-4 py-2 text-sm text-gray-300 focus:bg-white/5 focus:text-white focus:outline-hidden">Add Item</a>
       <a href="/uploads" class="block px-4 py-2 text-sm text-gray-300 focus:bg-white/5 focus:text-white focus:outline-hidden">upload file</a>
       <a href="/admin" class="block px-4 py-2 text-sm text-gray-300 focus:bg-white/5 focus:text-white focus:outline-hidden">Dashboard</a>
       @endif
      
      
        <a href="{{ route('orders.index') }}" class="block px-4 py-2 text-sm text-gray-300 focus:bg-white/5 focus:text-white focus:outline-hidden">My Order</a>
       <form method="post" action="/logout">
                    @csrf
        <button type="submit" class="block w-full px-4 py-2 text-left text-sm text-gray-300 focus:bg-white/5 focus:text-white focus:outline-hidden">Log out</button>
      </form>
    </div>
  </el-menu>
</el-dropdown>

 
@endauth


            </div>
        </nav>
        <el-dialog>
            <dialog id="mobile-menu" class="backdrop:bg-transparent lg:hidden">
                <div tabindex="0" class="fixed inset-0 focus:outline-none">
                    <el-dialog-panel
                        class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-gray-900 p-6 sm:max-w-sm sm:ring-1 sm:ring-gray-100/10"
                    >
                        <div class="flex items-center justify-between">
                            <a href="#" class="-m-1.5 p-1.5">
                                <span class="sr-only">Your Company</span>
                                <img src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500" alt="" class="h-8 w-auto" />
                            </a>
                            <button type="button" command="close" commandfor="mobile-menu" class="-m-2.5 rounded-md p-2.5 text-gray-200">
                                <span class="sr-only">Close menu</span>
                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    data-slot="icon"
                                    aria-hidden="true"
                                    class="size-6"
                                >
                                    <path d="M6 18 18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                        </div>
                        <div class="mt-6 flow-root">
                            <div class="-my-6 divide-y divide-white/10">
                                <div class="space-y-2 py-6">
                                    <a href="#" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-white hover:bg-white/5"
                                        >Product</a
                                    >
                                    <a href="#" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-white hover:bg-white/5"
                                        >Features</a
                                    >
                                    <a href="#" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-white hover:bg-white/5"
                                        >Marketplace</a
                                    >
                                    <a href="#" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-white hover:bg-white/5"
                                        >Company</a
                                    >
                                </div>
                                <div class="py-6">
                                    <a href="#" class="-mx-3 block rounded-lg px-3 py-2.5 text-base/7 font-semibold text-white hover:bg-white/5"
                                        >Log in</a
                                    >
                                </div>
                            </div>
                        </div>
                    </el-dialog-panel>
                </div>
            </dialog>
        </el-dialog>
    </header>
</div>

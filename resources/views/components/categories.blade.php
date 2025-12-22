
            <div class="flex items-center space-x-4">
                <div class="h-4 w-4 bg-white"></div>
                <span class="text-xl font-bold text-white">Categories</span>
            </div>

            <form method="GET" action="{{ route('items.show') }}">
                    @csrf
                    <input
                        type="text"
                         name="search"
                        value="{{ request('search') }}"
                        placeholder="Search"
                        class="mt-10 w-full rounded-2xl border-2 border-white bg-transparent px-5 py-3 text-2xl text-white focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                    />
                </form>

                
            <div class="mt-5 flex space-x-2">
                <a href="/search"
                   class="rounded-2xl bg-gray-700 px-3 py-2 font-medium text-white hover:bg-gray-600">
                    Shampoo
                </a>

               
            </div>
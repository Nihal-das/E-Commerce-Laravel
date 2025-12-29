<x-layout>
    <x-slot:heading>Update Item</x-slot:heading>

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
            <div class="mx-auto max-w-lg py-24 sm:py-32 lg:py-40 text-center" autocomplete="on">
                <form method="post"
                      action="{{ route('items.update', $item->id) }}"
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
                        Update Item
                    </h2>

                    <!-- ITEM NAME -->
                    <div class="text-left">
                        <label class="text-xl font-medium text-white">Item Name</label>
                        <input
                            type="text"
                            name="item_name"
                            autocomplete="off"
                            value="{{ $item->item_name }}"
                            class="mt-2 w-full rounded-md bg-white/5 px-4 py-2 text-white
                                   focus:outline-2 focus:outline-indigo-500"
                        />
                        @error('item_name')
                            <p class="mt-2 text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- PRICE -->
                    <div class="text-left">
                        <label class="text-xl font-medium text-white">Price</label>
                        <input
                            type="number"
                            name="price"
                            autocomplete="off"
                            value="{{ $item->price }}"
                            class="mt-2 w-full rounded-md bg-white/5 px-4 py-2 text-white
                                   focus:outline-2 focus:outline-indigo-500"
                        />
                        @error('price')
                            <p class="mt-2 text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- DESCRIPTION -->
                    <div class="text-left">
                        <label class="text-xl font-medium text-white">Description</label>
                        <textarea
                            name="description"
                            rows="4"
                           
                            class="mt-2 w-full rounded-md bg-white/5 px-4 py-2 text-white
                                   focus:outline-2 focus:outline-indigo-500"
                        >{{ $item->description }}</textarea>
                    </div>

                    <div class="">
                       @error('image')
                            <p class="mt-2 text-red-400">{{ $message }}</p>
                        @enderror
          <label for="image" class="text-left text-xl font-medium text-white">Item image</label>
          <div class="mt-2 flex justify-center rounded-lg border border-dashed border-white/25 px-6 py-10">
            <div class="text-center">
              <svg viewBox="0 0 24 24" fill="currentColor" data-slot="icon" aria-hidden="true" class="mx-auto size-12 text-gray-600">
                <path d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z" clip-rule="evenodd" fill-rule="evenodd" />
              </svg>
              <div class="mt-4 flex text-sm/6 text-gray-400">
                <label for="image_path" class="relative cursor-pointer rounded-md bg-transparent font-semibold text-indigo-400 focus-within:outline-2 focus-within:outline-offset-2 focus-within:outline-indigo-500 hover:text-indigo-300">
                  <span>Upload a file</span>
                  <input id="image_path" type="file"  onchange="previewImage(event)"  name="image_path" class="sr-only" />
                </label>
                <p class="pl-1">or drag and drop</p>
              </div>
              <p class="text-xs/5 text-gray-400">PNG, JPG, GIF up to 10MB</p>
            </div>
          </div>
          <img
    id="imagePreview"
    class="hidden mx-auto mb-4 h-48 w-auto rounded-xl object-cover border border-white/20"
/>
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

  <script>
function previewImage(event) {
    const input = event.target;
    const preview = document.getElementById('imagePreview');

    if (!input.files || !input.files[0]) return;

    const file = input.files[0];

    if (!file.type.startsWith('image/')) {
        alert('Please upload an image file');
        input.value = '';
        preview.classList.add('hidden');
        return;
    }

    const reader = new FileReader();
    reader.onload = () => {
        preview.src = reader.result;
        preview.classList.remove('hidden');
    };

    reader.readAsDataURL(file);
}
</script>

</x-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden p-10 shadow-sm sm:rounded-lg">

                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="py-3 w-full rounded-3xl bg-red-500 text-white p-4 mb-2">
                            {{ $error }}
                        </div>
                    @endforeach
                @endif

                <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') 

                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                            value="{{ old('name', $product->name) }}" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="price" :value="__('Price')" />
                        <x-text-input id="price" class="block mt-1 w-full" type="number" name="price"
                            value="{{ old('price', $product->price) }}" required autofocus autocomplete="price" />
                        <x-input-error :messages="$errors->get('price')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="category" :value="__('Category')" />
                        <select name="category_id" id="category_id"
                            class="py-3 rounded-lg pl-3 w-full border border-slate-300">
                            <option value="">Pilih Kategori Produk</option>

                            @forelse ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @empty
                            @endforelse
                        </select>
                        <x-input-error :messages="$errors->get('category')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="about" :value="__('About')" />
                        <textarea name="about" id="about" cols="30" rows="5" class="border border-slate-300 rounded-xl w-full">{{ old('about', $product->about) }}</textarea>
                        <x-input-error :messages="$errors->get('about')" class="mt-2" />
                    </div>

                    <!-- Icon Upload Input -->
                    <div class="mt-4">
                        <x-input-label for="photo" :value="__('Photo')" />
                        <img src="{{ Storage::url($product->photo) }}" alt="" class="w-[120px] h-[120px]">
                        <x-text-input id="photo" class="block mt-1 w-full" type="file" name="photo" autofocus
                            autocomplete="photo" onchange="previewFile()" />
                        <x-input-error :messages="$errors->get('photo')" class="mt-2" />
                    </div>

                    <!-- Preview of Uploaded File -->
                    <div class="mt-4">
                        <img id="file-preview" class="mt-2" style="max-width: 300px; display: none;" />
                    </div>

                    <!-- Preview of Uploaded File -->
                    <div class="mt-4">
                        <img id="file-preview" class="mt-2" style="max-width: 300px; display: none;" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button class="ms-4 update-product">
                            {{ __('Update Product') }}
                        </x-primary-button>
                    </div>
                </form>


            </div>
        </div>
    </div>

    <!-- SweetAlert Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        function previewFile() {
            const file = document.getElementById('photo').files[0];
            const preview = document.getElementById('file-preview');

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }

                reader.readAsDataURL(file);
            } else {
                preview.style.display = 'none';
            }
        }
    </script>

    <script>
            document.addEventListener('DOMContentLoaded', function() {
                const deleteButtons = document.querySelectorAll('.update-product');

                deleteButtons.forEach(button => {
                    button.addEventListener('click', function(event) {
                        event.preventDefault(); 

                        const form = this.closest('form'); 
                        Swal.fire({
                            title: 'Apakah Anda yakin?',
                            text: "product yang di update sudah sesuai!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ya, update aja!',
                            cancelButtonText: 'Batal'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit();
                            } else {
                                Swal.fire('update dibatalkan!');
                            }
                        });
                    });
                });
            });
    </script>

</x-app-layout>

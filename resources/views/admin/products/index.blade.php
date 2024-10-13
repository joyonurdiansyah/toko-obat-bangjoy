<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row w-full justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4 sm:mb-0">
                {{ __('Manage Products') }}
            </h2>
            <a href="{{ route('admin.products.create') }}"
                class="font-bold py-3 px-5 rounded-full text-white bg-indigo-700">Tambah Produk</a>
        </div>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white flex flex-col gap-y-5 overflow-hidden p-10 shadow-sm sm:rounded-lg">
                @forelse ($products as $product)
                    <div class="item-card flex flex-col sm:flex-row justify-between items-center gap-y-4 sm:gap-y-0">
                        <!-- Product Info -->
                        <div class="flex flex-row items-center gap-x-3">
                            <img src="{{ Storage::url($product->photo) }}" alt="" class="w-[50px] h-[50px]">
                            <div>
                                <h3 class="text-xl font-bold text-indigo-950">
                                    {{ $product->name }}
                                </h3>
                                <p class="text-base text-slate-500">
                                    Rp.{{ number_format($product->price, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
    
                        <!-- Product Category -->
                        <div class="ml-2 mr-2">
                            <p class="text-base text-slate-500 text-center sm:text-left">
                                {{ $product->category->name }}
                            </p>
                        </div>
    
                        <!-- Action Buttons -->
                        <div class="flex flex-col sm:flex-row items-center gap-y-3 sm:gap-x-3 ml-4">
                            <a href="{{ route('admin.products.edit', $product) }}"
                                class="font-bold py-3 px-5 rounded-full text-white bg-indigo-700">Edit</a>
                            <form method="POST" action="{{ route('admin.products.destroy', $product) }}"
                                class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="button"
                                    class="font-bold py-3 px-5 rounded-full text-white bg-red-700 delete-button">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p>Belum ada produk yang ditambahkan oleh pemilik apotek</p>
                @endforelse
            </div>
        </div>
    </div>
    

    <!-- SweetAlert Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.delete-button');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault(); 

                    const form = this.closest('form'); 
                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Kategori ini akan dihapus secara permanen!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        } else {
                            Swal.fire('Penghapusan dibatalkan!');
                        }
                    });
                });
            });
        });
    </script>
</x-app-layout>

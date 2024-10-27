<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col items-center justify-between w-full sm:flex-row">
            <h2 class="mb-4 text-xl font-semibold leading-tight text-gray-800 sm:mb-0">
                {{ __('Manage Products') }}
            </h2>
            <a href="{{ route('admin.products.create') }}"
                class="px-5 py-3 font-bold text-white bg-indigo-700 rounded-full">Tambah Produk</a>
        </div>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col p-10 overflow-hidden bg-white shadow-sm gap-y-5 sm:rounded-lg">
                @forelse ($products as $product)
                    <div class="flex flex-col items-center justify-between item-card sm:flex-row gap-y-4 sm:gap-y-0">
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
                            <p class="text-base text-center text-slate-500 sm:text-left">
                                {{ $product->category->name }}
                            </p>
                        </div>
            
                        <!-- Action Buttons -->
                        <div class="flex flex-col items-center ml-4 sm:flex-row gap-y-3 sm:gap-x-3">
                            <a href="{{ route('admin.products.edit', $product) }}"
                                class="px-5 py-3 font-bold text-white bg-indigo-700 rounded-full">Edit</a>
                            <form method="POST" action="{{ route('admin.products.destroy', $product) }}"
                                class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="button"
                                    class="px-5 py-3 font-bold text-white bg-red-700 rounded-full delete-button">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p>Belum ada produk yang ditambahkan oleh pemilik apotek</p>
                @endforelse
                
                <!-- Pagination -->
                <div class="mt-4">
                    {{ $products->links('vendor.pagination.tailwind') }}
                </div>
                
                <!-- Current Page Indicator -->
                <div class="mt-2 text-center">
                    <span class="font-bold text-blue-500">
                        Halaman {{ $products->currentPage() }} dari {{ $products->lastPage() }}
                    </span>
                </div>
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

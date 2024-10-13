<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row w-full justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manage Categories') }}
            </h2>
            <a href="{{ route('admin.categories.create') }}"
                class="font-bold py-3 px-5 rounded-full text-white bg-indigo-700">Add Category</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white flex flex-col gap-y-5 overflow-hidden p-10 shadow-sm sm:rounded-lg">

                @forelse ($categories as $category)
                    <div class="item-card flex flex-row justify-between items-center">
                        <img src="{{ Storage::url($category->icon) }}" alt="" class="w-[50px] h-[50px]">
                        <h3 class="text-xl font-bold text-indigo-950">
                            {{ $category->name }}
                        </h3>
                        <div class="flex flex-row items-center gap-x-3">
                            <a href="{{ route('admin.categories.edit', $category) }}"
                                class="font-bold py-3 px-5 rounded-full text-white bg-indigo-700">Edit</a>
                            <form method="POST" action="{{ route('admin.categories.destroy', $category) }}"
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
                    <p>Tidak ada kategori yang ditemukan.</p>
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

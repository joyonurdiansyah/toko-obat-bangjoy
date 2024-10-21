<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row w-full justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4 sm:mb-0">
                {{ Auth::user()->hasRole('owner') ? __('Apotek Orders') : __('My Transactions') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white flex flex-col gap-y-5 overflow-hidden p-10 shadow-sm sm:rounded-lg">
    
                @forelse ($product_transactions as $transaction)
                    <div class="item-card flex flex-col sm:flex-row justify-between items-center gap-y-4 sm:gap-y-0">
                        <!-- Product Info -->
                        <a href="{{ route('product_transactions.show', $transaction) }}">
                        <div class="flex flex-row items-center gap-x-3">
                            <div>
                                <p class="text-base text-slate-500">
                                    Total transaksi
                                </p>
                                <h3 class="text-xl font-bold text-indigo-950">
                                    Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}
                                </h3>
                            </div>
                        </div>
                        </a>
                        
    
                        <!-- Product Category -->
                        <div class="ml-2 mr-2 text-center">
                            <div class="hidden md:flex flex-col">
                                <p class="text-base text-slate-500">
                                    Date
                                </p>
                                <h3 class="text-xl font-bold text-indigo-950">
                                    {{$transaction->created_at}}
                                </h3>
                            </div>
                        </div>
    
                        @if($transaction->is_paid)
                            <span class="py-1 px-3 rounded-full text-white bg-green-500">
                                <p class="text-white font-bold text-sm">
                                    SUCCESS
                                </p>
                            </span>
                        @else
                            <span class="py-1 px-3 rounded-full text-white bg-orange-500">
                                <p class="text-white font-bold text-sm">
                                    PENDING
                                </p>
                            </span>
                        @endif
    
                        <!-- Action Buttons -->
                        <div class="hidden md:flex flex-col sm:flex-row items-center gap-y-3 sm:gap-x-3 ml-4">
                            <a href="{{ route('product_transactions.show', $transaction) }}"
                                class="font-bold py-3 px-5 rounded-full text-white bg-indigo-700">View Details</a>
                        </div>
                    </div>
    
                    <hr class="my-3">
                @empty
                    <p>
                        Belum ada transaksi terbaru
                    </p>
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

<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row w-full justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4 sm:mb-0">
                {{ __('Details') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white flex flex-col gap-y-5 overflow-hidden p-10 shadow-sm sm:rounded-lg">
                <div class="item-card flex flex-col sm:flex-row justify-between items-center gap-y-2 sm:gap-y-0">
                    <!-- Product Info -->
                    <div class="flex flex-row items-center gap-x-3">
                        <div>
                            <p class="text-base text-slate-500">
                                Total transaksi
                            </p>
                            <h3 class="text-xl font-bold text-indigo-950">
                                Rp {{ $productTransaction->total_amount }}
                            </h3>
                        </div>
                    </div>

                    <!-- Product Category -->
                    <div class="ml-2 mr-2">
                        <div>
                            <p class="text-base text-slate-500">
                                Date
                            </p>
                            <h3 class="text-xl font-bold text-indigo-950">
                                {{ $productTransaction->created_at }}
                            </h3>
                        </div>
                    </div>

                    <span class="py-1 px-3 rounded-full text-white bg-orange-500">
                        <p class="text-white font-bold text-sm">
                            PENDING
                        </p>
                    </span>

                    <!-- Action Buttons -->
                </div>

                <hr class="my-3">

                <h3 class="text-xl font-bold text-indigo-950">
                    List of Items
                </h3>

                <div class="grid grid-cols-4 gap-x-10">
                    <div class="flex flex-col gap-y-5 col-span-2">
                        <!-- Item Cards -->
                        @forelse ($productTransaction->transactionDetails as $detail)
                            @if ($detail->product)
                                <div class="item-card flex flex-col sm:flex-row justify-between items-center">
                                    <div class="flex flex-row items-center gap-x-3">
                                        <img src="{{Storage::url($detail->product->photo)}}" alt=""
                                            class="w-[50px] h-[50px]">
                                        <div>
                                            <h3 class="text-xl font-bold text-indigo-950">
                                                {{ $detail->product->name }}
                                            </h3>
                                            <p class="text-base text-slate-500">
                                                Rp {{ $detail->product->price }}
                                            </p>
                                        </div>
                                    </div>
                                    <p class="text-base text-slate-500">
                                        {{$detail->product->category->name}}
                                    </p>
                                </div>
                            @endif
                        @empty
                            <p>Tidak ada detail transaksi</p>
                        @endforelse


                        <h3 class="text-xl font-bold text-indigo-950">
                            Details Of Delivery
                        </h3>
                        <div class="item-card flex flex-col sm:flex-row justify-between items-center">
                            <p class="text-base text-slate-500">
                                Address
                            </p>

                            <h3 class="text-xl font-bold text-indigo-950">
                                {{ $productTransaction->address }}
                            </h3>
                        </div>
                        <div class="item-card flex flex-col sm:flex-row justify-between items-center">
                            <p class="text-base text-slate-500">
                                City
                            </p>

                            <h3 class="text-xl font-bold text-indigo-950">
                                {{ $productTransaction->city }}
                            </h3>
                        </div>
                        <div class="item-card flex flex-col sm:flex-row justify-between items-center">
                            <p class="text-base text-slate-500">
                                Post Code
                            </p>

                            <h3 class="text-xl font-bold text-indigo-950">
                                {{ $productTransaction->post_code }}
                            </h3>
                        </div>
                        <div class="item-card flex flex-col sm:flex-row justify-between items-center">
                            <p class="text-base text-slate-500">
                                Phone Number
                            </p>

                            <h3 class="text-xl font-bold text-indigo-950">
                                {{ $productTransaction->phone_number }}
                            </h3>
                        </div>
                        <div class="item-card flex flex-col justify-between items-start">
                            <p class="text-base text-slate-500">
                                Notes
                            </p>

                            <h3 class="text-lg font-bold text-indigo-950">
                                {{ $productTransaction->notes }}
                            </h3>
                        </div>
                    </div>

                    <div class="flex flex-col gap-y-5 col-span-2 items-end">
                        <h3 class="text-xl font-bold text-indigo-950">
                            Proof of Payment:
                        </h3>

                        <img src="{{ Storage::url($productTransaction->proof) }}"
                            alt="{{ Storage::url($productTransaction->proof) }}" class="w-[300px] h-[400px]">
                    </div>
                </div>

                <hr class="my-3">

                @role('owner')
                    <form method="POST" action="{{ route('product_transactions.update', 1) }}" class="delete-form">
                        @csrf
                        @method('PUT')
                        <button type="button"
                            class="font-bold py-3 px-5 rounded-full text-white bg-indigo-700 delete-button">
                            Approve Order
                        </button>
                    </form>
                @endrole

                @role('buyer')
                    <a href="#" type="button"
                        class="w-fit font-bold py-3 px-5 rounded-full text-white bg-indigo-700 delete-button">
                        Contact Admin
                    </a>
                @endrole

            </div>
        </div>
    </div>


    <!-- SweetAlert Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- <script>
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
    </script> --}}
</x-app-layout>

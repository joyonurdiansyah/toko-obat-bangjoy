<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="flex flex-col p-6 text-gray-900 md:flex-row">
                    <div class="flex items-center justify-center w-full mb-4 md:w-1/2 md:mb-0">
                        <!-- Gambar dari assets -->
                        <img src="{{ asset('assets/images/ilustrasi_mobile_app.png') }}" alt="Ilustrasi Mobile App" class="h-auto max-w-full">
                    </div>
                    <div class="w-full p-4 md:w-1/2">
                        <!-- Keterangan pengguna yang login -->
                        <h3 class="text-lg font-bold">Selamat datang, {{ Auth::user()->name }}!</h3>
                        <h3 class="mt-4 text-lg font-bold">Aplikasi Toko Obat Parmajoy</h3>
                        <p class="mt-2">
                            Aplikasi Toko Obat Parmajoy adalah platform yang memudahkan pelanggan untuk mencari, membeli, dan mendapatkan informasi tentang produk obat. Dengan tampilan yang user-friendly dan fitur pencarian yang cepat, pengguna dapat dengan mudah menemukan obat yang dibutuhkan.
                        </p>
                        <p class="mt-2">
                            Fitur utama dari aplikasi ini termasuk pemesanan online, riwayat pembelian, dan notifikasi tentang produk terbaru.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New Category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden p-10 shadow-sm sm:rounded-lg">

                @if($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="py-3 w-full rounded-3xl bg-red-500 text-white p-4 mb-2">
                            {{$error}}
                        </div>
                    @endforeach
                @endif

                <form method="POST" action="{{ route('admin.categories.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                            :value="old('name')" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>


                    <!-- Icon Upload Input -->
                    <div class="mt-4">
                        <x-input-label for="Icon" :value="__('Icon')" />
                        <x-text-input id="Icon" class="block mt-1 w-full" type="file" name="icon" required
                            autofocus autocomplete="Icon" onchange="previewFile()" />
                        <x-input-error :messages="$errors->get('Icon')" class="mt-2" />
                    </div>

                    <!-- Preview of Uploaded File -->
                    <div class="mt-4">
                        <img id="file-preview" class="mt-2" style="max-width: 300px; display: none;" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button class="ms-4">
                            {{ __('Add New Category') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script>
        function previewFile() {
            const file = document.getElementById('Icon').files[0];
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

</x-app-layout>

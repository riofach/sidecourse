<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Update Category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div
                class="bg-white dark:bg-gray-800 overflow-hidden p-10 shadow-sm sm:rounded-lg transition-all duration-300 ease-in-out transform hover:scale-105">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div
                            class="py-3 w-full rounded-lg bg-red-500 text-white mb-4 px-4 transition-all duration-300 ease-in-out">
                            {{ $error }}
                        </div>
                    @endforeach
                @endif

                <form method="POST" action="{{ route('admin.categories.update', $category) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <x-input-label for="name" :value="__('Name')" class="text-gray-700 dark:text-gray-300" />
                        <x-text-input value="{{ $category->name }}" id="name"
                            class="block mt-1 w-full transition-all duration-300 ease-in-out" type="text"
                            name="name" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mb-6">
                        <x-input-label for="icon" :value="__('Icon')" class="text-gray-700 dark:text-gray-300" />
                        <img src="{{ Storage::url($category->icon) }}" alt=""
                            class="rounded-lg object-cover w-[90px] h-[90px] mb-2 transition-all duration-300 ease-in-out transform hover:scale-110">
                        <x-text-input id="icon" class="block mt-1 w-full transition-all duration-300 ease-in-out"
                            type="file" name="icon" autofocus autocomplete="icon" />
                        <x-input-error :messages="$errors->get('icon')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end">
                        <button type="submit"
                            class="font-bold py-3 px-6 bg-indigo-700 text-white rounded-full transition-colors duration-300 hover:bg-indigo-600">
                            Update Category
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

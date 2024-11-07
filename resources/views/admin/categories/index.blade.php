<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Manage Categories') }}
            </h2>
            <a href="{{ route('admin.categories.create') }}"
                class="font-bold py-3 px-6 bg-indigo-700 text-white rounded-full transition-colors duration-300 hover:bg-indigo-600">
                Add New
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-10 flex flex-col gap-y-5">
                @forelse ($categories as $category)
                    <div
                        class="item-card flex flex-row justify-between items-center bg-gray-50 dark:bg-gray-700 p-6 rounded-lg shadow-md transition-all duration-300 ease-in-out transform hover:scale-105">
                        <div class="flex flex-row items-center gap-x-3">
                            <img src="{{ Storage::url($category->icon) }}" alt=""
                                class="rounded-lg object-cover w-[90px] h-[90px] transition-all duration-300 ease-in-out transform hover:scale-110">
                            <div class="flex flex-col">
                                <h3 class="text-indigo-950 dark:text-indigo-200 text-xl font-bold">{{ $category->name }}
                                </h3>
                            </div>
                        </div>
                        <div class="hidden md:flex flex-col">
                            <p class="text-slate-500 dark:text-slate-400 text-sm">Date</p>
                            <h3 class="text-indigo-950 dark:text-indigo-200 text-xl font-bold">
                                {{ $category->created_at->format('Y-m-d') }}</h3>
                        </div>
                        <div class="hidden md:flex flex-row items-center gap-x-3">
                            <a href="{{ route('admin.categories.edit', $category) }}"
                                class="font-bold py-3 px-6 bg-indigo-700 text-white rounded-full transition-colors duration-300 hover:bg-indigo-600">
                                Edit
                            </a>
                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="font-bold py-3 px-6 bg-red-700 text-white rounded-full transition-colors duration-300 hover:bg-red-600">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 dark:text-gray-400">No categories found</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>

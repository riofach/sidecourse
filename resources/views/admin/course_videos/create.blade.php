<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Video to Course') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div
                class="bg-white dark:bg-gray-800 overflow-hidden p-10 shadow-sm sm:rounded-lg transition-all duration-300 ease-in-out transform hover:scale-105">

                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="py-3 w-full rounded-3xl bg-red-500 text-white">
                            {{ $error }}
                        </div>
                    @endforeach
                @endif

                <div class="item-card flex flex-row gap-y-10 justify-between items-center">
                    <div class="flex flex-row items-center gap-x-3">
                        <img src="{{ Storage::url($course->thumbnail) }}" alt=""
                            class="rounded-2xl object-cover w-[120px] h-[90px] transition-all duration-300 ease-in-out transform hover:scale-110">
                        <div class="flex flex-col">
                            <h3 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                                {{ $course->name }}</h3>
                            <p class="text-slate-500 dark:text-slate-400 text-sm">{{ $course->category->name }}</p>
                        </div>
                    </div>
                    <div>
                        <p class="text-slate-500 dark:text-slate-400 text-sm">Teacher</p>
                        <h3 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                            {{ $course->teacher->user->name }}</h3>
                    </div>
                </div>

                <hr class="my-5">

                <form method="POST" action="{{ route('admin.course.add_video.save', $course->id) }}"
                    enctype="multipart/form-data">
                    @csrf

                    <div>
                        <x-input-label for="name" :value="__('Name')" class="text-gray-700 dark:text-gray-300" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                            :value="old('name')" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="path_video" :value="__('path_video')" class="text-gray-700 dark:text-gray-300" />
                        <x-text-input id="path_video" class="block mt-1 w-full" type="text" name="path_video"
                            :value="old('path_video')" required autofocus autocomplete="path_video" />
                        <x-input-error :messages="$errors->get('path_video')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">

                        <button type="submit"
                            class="font-bold py-3 px-6 bg-indigo-700 text-white rounded-full transition-colors duration-300 hover:bg-indigo-600">
                            Add New Video
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>

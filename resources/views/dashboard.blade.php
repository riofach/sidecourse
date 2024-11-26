<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ Auth::user()->hasRole('owner') ? __('Owner Dashboard') : __('Dashboard') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div
                class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-10 flex flex-col gap-y-5 transition-all duration-300 ease-in-out transform hover:scale-105">
                @role('owner')
                    <div class="item-card grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-10">
                        <x-dashboard-card icon="Course.png" title="Courses" :value="$courses" />
                        <x-dashboard-card icon="Transaction.png" title="Transactions" :value="$transactions" />
                        <x-dashboard-card icon="Students.png" title="Students" :value="$students" />
                        <x-dashboard-card icon="Teachers.png" title="Teachers" :value="$teachers" />
                        <x-dashboard-card icon="Category.png" title="Categories" :value="$categories" />
                        <a href="{{ route('front.index') }}"
                            class="w-fit font-bold py-4 px-6 bg-cyan-700 text-white rounded-full transition-colors duration-300 hover:bg-cyan-500">
                            Explore Catalog
                        </a>
                    </div>
                @endrole
                @role('teacher')
                    <div class="item-card grid grid-cols-1 md:grid-cols-3 gap-10">
                        <x-dashboard-card icon="Course.png" title="Courses" :value="$courses" />
                        <x-dashboard-card icon="Students.png" title="Students" :value="$students" />
                        <a href="{{ route('admin.courses.create') }}"
                            class="w-full h-full flex items-center justify-center font-bold py-4 px-6 bg-indigo-700 text-white rounded-lg transition-colors duration-300 hover:bg-indigo-600">
                            Create New Course
                        </a>
                        <a href="{{ route('front.index') }}"
                            class="w-fit font-bold py-4 px-6 bg-cyan-700 text-white rounded-full transition-colors duration-300 hover:bg-cyan-500">
                            Explore Catalog
                        </a>
                    </div>
                @endrole
                @role('student')
                    <h3 class="text-indigo-950 dark:text-indigo-200 font-bold text-2xl mb-4">Upgrade Skills Today
                        {{ Auth::user()->name }}</h3>
                    <p class="text-slate-500 dark:text-slate-400 text-base mb-6">
                        Grow your career with experienced teachers in SideCourse.
                    </p>
                    <a href="{{ route('front.index') }}"
                        class="w-fit font-bold py-4 px-6 bg-cyan-700 text-white rounded-full transition-colors duration-300 hover:bg-cyan-500">
                        Explore Catalog
                    </a>
                @endrole
            </div>
        </div>
    </div>

    <!-- Tambahkan SweetAlert2 -->
    @if (session('success'))
        <div id="flash-message" data-message="{{ session('success') }}" data-type="success"></div>
    @endif
</x-app-layout>

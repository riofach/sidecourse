@props(['icon', 'title', 'value'])

<div
    class="flex flex-col gap-y-3 p-6 bg-gray-50 dark:bg-gray-700 rounded-lg shadow-md transition-all duration-300 ease-in-out transform hover:scale-105">
    <img width="46" height="46" src="{{ Storage::url('icons/' . $icon) }}" alt="{{ $title }}" class="mb-2">
    <div>
        <p class="text-slate-500 dark:text-slate-400 text-sm mb-1">{{ $title }}</p>
        <h3 class="text-indigo-950 dark:text-indigo-200 text-xl font-bold">{{ $value }}</h3>
    </div>
</div>

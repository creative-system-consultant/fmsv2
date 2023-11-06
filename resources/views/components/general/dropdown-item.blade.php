@props([
    'index' => '',
    'icon' => '',
    'title' => '',
])
<div>
    <li @click.prevent="toggleDropdown({{ $index }})" class="flex items-center justify-between cursor-pointer hover:bg-primary-50 dark:hover:bg-gray-800 focus:outline-none">
        <p class="inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white">
            <x-icon name="{{ $icon }}" class="w-4 h-4 mr-2"/>
            <span class="search-item">{{ $title }}</span>
        </p>
        <div class="px-4" x-show="!showDropdowns[{{ $index }}] && !searchTerm.length" x-cloak>
            <x-icon name="chevron-left" class="inline-flex w-5 h-5 text-gray-500 dark:text-white"/>
        </div>
        <div class="px-4" x-show="showDropdowns[{{ $index }}] || searchTerm.length" x-cloak>
            <x-icon name="chevron-down" class="inline-flex w-5 h-5 text-gray-500 dark:text-white"/>
        </div>
    </li>
    <div x-show="shouldShowDropdown({{ $index }})" class="px-4 bg-gray-100 dark:bg-gray-800">
        {{ $slot }}
    </div>
</div>
@props([
    'href' => '',
    'title' => '',
])
<li x-show="itemMatches($el)">
    <a wire:navigate href="{{$href}}" class="inline-flex items-center w-full px-4 py-2 text-sm font-semibold text-gray-500 dark:text-white hover:text-primary-500">
        <x-icon name="clipboard-list" class="w-4 h-4 mr-2"/>
        <span class="search-item">{{$title}}</span>
    </a>
</li>
<div x-data="{ showDropdown: false }" class="relative inline-block">
    <button
        @click.away="showDropdown = false"
        x-on:click="showDropdown = !showDropdown"
        class="flex items-center justify-center px-2 py-2 border-2 rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-800 dark:border-gray-700 ">
        <x-icon name="dots-horizontal" class="w-5 h-5 "/>
    </button>
    <div x-show="showDropdown" x-cloak x-ref="dropdownContent" class="w-40 bg-white rounded-md shadow-lg dark:bg-gray-800 dark:text-gray-400" style="z-index: 9999 !important;">
        {{$slot}}
    </div>
</div>

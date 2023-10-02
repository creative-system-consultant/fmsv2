@props([
    'route' => '',
    'activeUrl' => '',
    'title' => '',
    'iconName' => '',

])

<!-- desktop -->
<li
    class="relative hidden lg:block"
    x-data="{ showDropdown: false }"
    @mouseover="showDropdown = true"
    @mouseout="showDropdown = false">
    <a  wire:navigate href="{{ $route }}"
        class="flex items-center px-4 py-2 text-base font-normal  rounded-lg hover:bg-primary-50 hover:text-primary-600  dark:hover:text-primary-600 mb-2 dark:hover:bg-gray-800
        animate__animated animate__fadeInLeft animate__faster
        {{Route::current()->uri == $activeUrl ? ' bg-primary-50 hover:border-0 text-primary-600 dark:bg-gray-800' : 'bg-transparent text-gray-900 dark:text-white'}}
        ">
        <span class=" animate__animated animate__fadeInLeft animate__fast">
            {{$iconName}}
        </span>
        <span class="ml-3 text-sm font-medium myFontSemibold "
        :class="toggleMiniSidebar == true ? 'hidden' : 'block'"
        >
        {{$title}}
        </span>
    </a>
    <div
        :class="toggleMiniSidebar == true ? 'block' : 'hidden'"
        x-show="showDropdown"
        x-cloak
        x-ref="dropdownContent"
        class="absolute px-4 py-2 w-40  bg-white rounded-md shadow-2xl top-1 text-primary-600 dark:bg-gray-900 dark:text-primary-500 left-[3.6rem] border dark:border-gray-800"
        style="z-index: 9999 !important;">
        {{$title}}
    </div>
</li>

<!-- mobile -->
<li  class="relative block lg:hidden">
    <a  wire:navigate href="{{ $route }}"
        class="flex items-center px-4 py-2 text-base font-normal  rounded-lg hover:bg-primary-50 hover:text-primary-600  dark:hover:text-primary-600 mb-2 dark:hover:bg-gray-800
        animate__animated animate__fadeInLeft animate__faster
        {{Route::current()->uri == $activeUrl ? ' bg-primary-50 hover:border-0 text-primary-600 dark:bg-gray-800' : 'bg-transparent text-gray-900 dark:text-white'}}
        ">
        <span class=" animate__animated animate__fadeInLeft animate__fast">
            {{$iconName}}
        </span>
        <span class="ml-3 text-sm font-medium myFontSemibold "
        >
        {{$title}}
        </span>
    </a>
</li>

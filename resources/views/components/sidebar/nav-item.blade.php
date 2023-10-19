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
        {{\Request::is($activeUrl) ? ' bg-primary-50 hover:border-0 text-primary-600 dark:bg-gray-800' : 'bg-transparent text-gray-900 dark:text-white'}}
        ">
        <span class=" animate__animated animate__fadeInLeft animate__fast">
            {{$iconName}}
        </span>
        <span class="ml-3 text-sm font-medium myFontSemibold"
            :class="{ 'hidden': toggleMiniSidebar, 'block': !toggleMiniSidebar }" x-cloak>
            {{$title}}
        </span>

        <span class="ml-3 text-sm font-medium myFontSemibold"
            :class="{ 'block': toggleMiniSidebar && openHoverMiniSidebar, 'hidden': !toggleMiniSidebar || !openHoverMiniSidebar }" x-cloak>
            {{$title}}
        </span>
    </a>
</li>

<!-- mobile -->
<li  class="relative block lg:hidden">
    <a  wire:navigate href="{{ $route }}"
        class="flex items-center px-4 py-2 text-base font-normal  rounded-lg hover:bg-primary-50 hover:text-primary-600  dark:hover:text-primary-600 mb-2 dark:hover:bg-gray-800
        animate__animated animate__fadeInLeft animate__faster
        {{\Request::is($activeUrl) ? ' bg-primary-50 hover:border-0 text-primary-600 dark:bg-gray-800' : 'bg-transparent text-gray-900 dark:text-white'}}
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

@props([
    'activeUrl' => '',
    'title' => '',
    'iconName' => '',
    'navItem'=> '',

])

<! -- desktop -->
<li class="relative hidden animate__animated animate__fadeInLeft animate__faster lg:block"
    x-data="{ showDropdown: false }"
    @mouseover="showDropdown = true"
    @mouseout="showDropdown = false">
    <details
        :class="toggleMiniSidebar == true ? 'hidden' : 'block'"
        class="group [&_summary::-webkit-details-marker]:hidden"
        @if(\Request::is($activeUrl))
            open
        @endif>
        <summary
            class="flex items-center px-4 py-2  cursor-pointer  rounded-lg hover:bg-primary-50 hover:text-primary-600  dark:hover:text-primary-600  dark:hover:bg-gray-800
            {{\Request::is($activeUrl) ? ' bg-primary-50 hover:border-0 text-primary-600 dark:bg-gray-800 ' : 'bg-transparent text-gray-900 dark:text-white'}}">
            <span>
            {{$iconName}}
            </span>
            <span class="ml-3 text-sm font-medium myFontSemibold"> {{$title}} </span>
            <span class="ml-auto transition duration-300 shrink-0 group-open:-rotate-180">
                <x-icon name="chevron-down" class="w-4 h-4"/>
            </span>
        </summary>

        <nav class="mt-1.5 ml-8 flex flex-col">
            {{$navItem}}
        </nav>
    </details>

    <!-- for mini sidebar -->
    <div
        :class="toggleMiniSidebar == true ? 'block' : 'hidden'"
        @if(\Request::is($activeUrl))
            open
        @endif>
        <div
            class="flex items-center px-4 py-2  cursor-pointer  rounded-lg hover:bg-primary-50 hover:text-primary-600  dark:hover:text-primary-600  dark:hover:bg-gray-800
            {{\Request::is($activeUrl) ? ' bg-primary-50 hover:border-0 text-primary-600 dark:bg-gray-800 ' : 'bg-transparent text-gray-900 dark:text-white'}}">
            <span>
                {{$iconName}}
            </span>
            <span class="ml-3 text-sm font-medium myFontSemibold"
            :class="toggleMiniSidebar == true ? 'hidden' : 'block'"> {{$title}}
            </span>
        </div>
    </div>
    <div
        :class="toggleMiniSidebar == true ? 'block' : 'hidden'"
        x-show="showDropdown"
        x-cloak
        x-ref="dropdownContent"
        class="absolute w-64 px-4 py-2  bg-white rounded-md shadow-2xl top-1 text-primary-600 dark:bg-gray-900 dark:text-primary-500 left-[3.6rem] border dark:border-gray-800"
        style="z-index: 9999 !important;">
        <div class="pb-1 border-b dark:border-gray-800">
            {{$title}}
        </div>
        <div class="mt-2">
            {{$navItem}}
        </div>
    </div>
</li>

<! -- mobile -->
<li class="relative block animate__animated animate__fadeInLeft animate__faster lg:hidden">
    <details  class="group [&_summary::-webkit-details-marker]:hidden"
        @if(\Request::is($activeUrl))
            open
        @endif>
        <summary
            class="flex items-center px-4 py-2  cursor-pointer  rounded-lg hover:bg-primary-50 hover:text-primary-600  dark:hover:text-primary-600  dark:hover:bg-gray-800
            {{\Request::is($activeUrl) ? ' bg-primary-50 hover:border-0 text-primary-600 dark:bg-gray-800 ' : 'bg-transparent text-gray-900 dark:text-white'}}">
            <span>
            {{$iconName}}
            </span>
            <span class="ml-3 text-sm font-medium myFontSemibold">{{$title}}</span>
            <span class="ml-auto transition duration-300 shrink-0 group-open:-rotate-180">
                <x-icon name="chevron-down" class="w-4 h-4"/>
            </span>
        </summary>

        <nav class="mt-1.5 ml-8 flex flex-col">
            {{$navItem}}
        </nav>
    </details>
</li>

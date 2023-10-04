@props([
    'activeUrl' => '',
    'title' => '',
])

<ul class="list-none" x-data="{open:false}">
    <li 
        :class="toggleMiniSidebar == true ? '' : ' animate__animated animate__fadeInLeft animate__faster'"
        class="relative"  x-on:click="open = !open;" >
        <details  class="">
            <summary
                class="flex items-center px-4 py-2  cursor-pointer  rounded-lg  hover:text-primary-600  dark:hover:text-primary-600 
                {{\Request::is($activeUrl) ? 'hover:border-0 text-primary-600 ' : 'bg-transparent text-gray-900 dark:text-white'}}">
                <span class="ml-3 text-sm font-medium myFontSemibold">{{$title}}</span>
                <span class="ml-auto transition duration-300 shrink-0">
                    <div x-show="open == false">
                        <x-icon name="chevron-down" class="w-4 h-4"/>
                    </div>
                    <div x-show="open == true">
                        <x-icon name="chevron-up" class="w-4 h-4"/>
                    </div>
                </span>
            </summary>

            <nav class="mt-1.5 ml-8 flex flex-col "
            :class="toggleMiniSidebar == true ? 'h-96  overflow-y-auto' : ''">
                {{$navitem}}
            </nav>
        </details>
    </li>
</ul>
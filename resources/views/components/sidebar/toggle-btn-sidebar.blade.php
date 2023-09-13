
<div>
    <div  class="relative block lg:hidden">
        <button
            x-on:click="toggleSidebarMobile = !toggleSidebarMobile"
            class="px-3 py-2 border-2 rounded cursor-pointer backdrop-blur-xl bg-white/60 dark:bg-gray-900 dark:text-primary-600 dark:border-gray-800 ">
            <x-icon x-cloak x-show="toggleSidebarMobile == false" name="menu" class="w-6 h-6" />
            <x-icon x-cloak x-show="toggleSidebarMobile == true" name="menu-alt-1" class="w-6 h-6" />
        </button>
    </div>

    <div
        x-data="{ show: false }"
        @click.away="show = false"
        class="relative hidden lg:block"
    >
        <div>
            <button
                x-on:click="show = !show;"
                class="px-3 py-2 border-2 rounded cursor-pointer backdrop-blur-xl bg-white/60 dark:bg-gray-900 dark:text-primary-600 dark:border-gray-800 ">
                <x-icon name="menu" class="w-6 h-6" />
            </button>
        </div>
        <div
            x-show="show"
            class="absolute top-[3rem] py-2  text-gray-600 bg-white rounded shadow-lg cursor-pointer w-52 dark:bg-gray-900 dark:text-white border dark:border-gray-800"
            >
            <div>
                <button
                    x-on:click="toggleSidebarDesktop = !toggleSidebarDesktop; localStorage.setItem('toggleSidebarDesktop', toggleSidebarDesktop) , show = false"
                    class="w-full ">

                    <div class="flex items-center px-4 py-2 space-x-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700" x-cloak x-show="!toggleSidebarDesktop">
                        <x-icon x-cloak name="eye-off" class="w-4 h-4" />
                        <p class="text-sm">Hide Sidebar</p>
                    </div>
                    <div class="flex items-center px-4 py-2 space-x-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700" x-cloak x-show="toggleSidebarDesktop">
                        <x-icon x-cloak name="eye" class="w-4 h-4" />
                        <p class="text-sm">Show Sidebar</p>
                    </div>
                </button>
            </div>

            <div :class="toggleSidebarDesktop == true ? 'hidden' : 'block'">
                <button
                    x-on:click="toggleMiniSidebar = !toggleMiniSidebar; localStorage.setItem('toggleMiniSidebar', toggleMiniSidebar) , show = false"
                    class="w-full" >
                    <div class="flex items-center px-4 py-2 space-x-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700" x-cloak x-show="!toggleMiniSidebar">
                        <x-icon x-cloak name="dots-vertical" class="w-4 h-4" />
                        <p class="text-sm">Mini Sidebar</p>
                    </div>
                    <div class="flex items-center px-4 py-2 space-x-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700" x-cloak x-show="toggleMiniSidebar">
                        <x-icon x-cloak  name="dots-horizontal" class="w-4 h-4" />
                        <p class="text-sm">Expanded Sidebar</p>
                    </div>
                </button>
            </div>
        </div>
    </div>
</div>

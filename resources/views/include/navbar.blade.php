<header
        x-data="{ atTop: (window.pageYOffset > 50) ? false : true }"
        x-init="() => { atTop = (window.pageYOffset > 50) ? true : false }"
        @scroll.window.window="atTop = (window.pageYOffset > 50) ? true : false"
        class="sticky top-0 z-30 w-full py-3 backdrop-blur-xl bg-white/60 dark:bg-gray-900/90 dark:border-gray-600 lg:pr-4"
        :class="{'': atTop, ' lg:backdrop-blur-none lg:bg-transparent lg:dark:bg-transparent': !atTop}"
    >
    <div class="px-3 lg:pl-3">
        <div class="flex items-center justify-between">
            <x-sidebar.toggle-btn-sidebar/>
            <div class="flex items-center space-x-6 animate__animated animate__fadeInRight">
                <div class="hidden lg:block">
                    <x-toggle-theme/>
                </div>

                <div class="relative " x-data="{menuOpen:false}" x-cloak>
                    <div x-on:click="menuOpen = !menuOpen" @click.away="menuOpen = false"
                        class="flex items-center space-x-2 cursor-pointer">

                        <p class="w-24 dark:text-gray-400 line-clamp-1">{{ auth()->user()->name }}</p>
                    </div>
                    <div x-show="menuOpen"
                        class="absolute right-0 z-10 w-56 mt-2 origin-top-right bg-white border-2 border-gray-100 rounded-md shadow-lg dark:bg-gray-800 dark:border-gray-700"
                        role="menu">
                        <div>
                            <a href="#"
                                class="flex items-center px-4 py-2 text-sm font-medium text-gray-500 rounded-lg hover:bg-gray-50 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-700">
                                <x-icon name="user-circle" class="w-4 h-4 mr-2" />
                                Profile
                            </a>
                        </div>
                        <div>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                class="flex items-center px-4 py-2 text-sm font-medium text-gray-500 rounded-lg hover:bg-gray-50 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-700">
                                <x-icon name="logout" class="w-4 h-4 mr-2" />
                                Log Out
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

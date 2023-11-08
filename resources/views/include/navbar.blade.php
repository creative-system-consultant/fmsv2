<header
        x-data="{ atTop: (window.pageYOffset > 50) ? false : true }"
        x-init="() => { atTop = (window.pageYOffset > 50) ? true : false }"
        @scroll.window.window="atTop = (window.pageYOffset > 50) ? true : false"
        class="sticky top-0 z-10 w-full py-3 backdrop-blur-xl bg-white/60 dark:bg-gray-900/90 dark:border-gray-600 lg:pr-4"
        :class="{'': atTop, ' lg:backdrop-blur-none lg:bg-transparent lg:dark:bg-transparent': !atTop}"
    >
    <div class="px-3 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
            <x-sidebar.toggle-btn-sidebar/>
            <div class="hidden lg:block">
                <x-toggle-theme/>
            </div>
            </div>

            <div class="flex items-center space-x-6 animate__animated animate__fadeInRight">
                
                <div class="hs-dropdown [--strategy:static] sm:[--strategy:absolute] [--adaptive:none]">
                    <div class="flex items-center p-1.5 space-x-2 bg-white/70 backdrop-blur-lg rounded-full cursor-pointer relative dark:bg-gray-900 w-10 h-10  justify-center">
                        <x-icon name="bell" class="w-6 h-6 text-primary-500" />
                        <div class="absolute flex items-center justify-center px-2 py-0.5 text-xs bg-red-500 rounded-full -right-2 -top-1 border">
                            <p class="text-[0.55rem] text-white">1</p>
                        </div>
                    </div>
                    <div class="hs-dropdown-menu transition-[opacity,margin] sm:border duration-[0.1ms] sm:duration-[150ms] hs-dropdown-open:opacity-100 opacity-0 w-full hidden z-10 top-full right-40 min-w-[18rem] bg-white sm:shadow-md rounded-lg p-2 dark:bg-gray-800 sm:dark:border dark:border-gray-700 dark:divide-gray-700 before:absolute before:-top-5 before:left-0 before:w-full before:h-5">
                        <div>
                            <a href="#"
                                class="flex items-center px-2 py-2 text-xs font-medium text-gray-500 rounded-lg hover:bg-gray-50 hover:text-gray-700 dark:text-gray-400 dark:hover:bg-gray-700">
                                <x-icon name="check-circle" class="w-4 h-4 mr-2 text-green-500" />
                                Report List Of Member
                            </a>
                        </div>
                    </div>
                </div>

                <div class="relative " x-data="{menuOpen:false}" x-cloak>
                    <div x-on:click="menuOpen = !menuOpen" @click.away="menuOpen = false"
                        class="flex items-center space-x-2 cursor-pointer">
                        <x-avatar md src="https://picsum.photos/300?size=md" />
                        <p class="w-14 dark:text-gray-200 line-clamp-1" :class="{'': atTop, ' text-black xl:text-white': !atTop}">
                            {{ auth()->user()->name }}
                        </p>
                    </div>
                    <div x-show="menuOpen"
                        class="absolute right-0 z-10 w-56 mt-2 origin-top-right bg-white border-2 border-gray-100 rounded-md shadow-lg dark:bg-gray-800 dark:border-gray-700"
                        role="menu">
                        <div>
                            <a wire:navigate href="{{route('profile')}}"
                                class="flex items-center px-4 py-2 text-sm font-medium text-gray-500 rounded-lg hover:bg-gray-50 hover:text-gray-700 dark:text-gray-400 dark:hover:bg-gray-700">
                                <x-icon name="user-circle" class="w-4 h-4 mr-2" />
                                Profile
                            </a>
                        </div>
                        <div>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                class="flex items-center px-4 py-2 text-sm font-medium text-gray-500 rounded-lg hover:bg-gray-50 hover:text-gray-700 dark:text-gray-400 dark:hover:bg-gray-700">
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

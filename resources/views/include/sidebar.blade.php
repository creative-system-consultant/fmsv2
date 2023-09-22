
<div x-cloak >
    <aside
        x-cloak
        class="fixed top-0 left-0 z-20 flex flex-col flex-shrink-0 h-full duration-75 lg:flex transition-width"
        :class="{
            'block lg:hidden': toggleSidebarDesktop,
            'w-64 lg:w-[5rem]': toggleMiniSidebar,
            'w-64' : !toggleMiniSidebar,
            'animate__animated animate__slideInLeft': toggleSidebarMobile,
            'hidden lg:block': !toggleSidebarMobile
        }"
        >
        <div class="relative flex flex-col flex-1 min-h-0 pt-0 border-r border-gray-200 backdrop-blur-xl bg-white/60 dark:bg-gray-900 dark:border-gray-800">
            <a href="{{ route('home') }}" class="flex items-center justify-center pt-4 text-xl font-bold">
                <div x-show="!toggleMiniSidebar">
                    <x-logo class="w-auto h-12" />
                </div>
                <div x-show="toggleMiniSidebar">
                    <x-logo class="w-auto h-12 lg:h-6" />
                </div>
            </a>
            <div class="flex flex-col flex-1 pt-5 pb-4 "
                :class="toggleMiniSidebar == true ? '' : 'overflow-y-auto'">
                <div class="flex-1 px-3 space-y-1 divide-y">
                    <ul class="pt-4 pb-2 space-y-2 list-none">
                        <div class="block pb-6 lg:hidden">
                            <x-toggle-theme/>
                        </div>

                        <x-sidebar.nav-item
                            title="Dashboard"
                            activeUrl="home"
                            route="{{ route('home') }}"
                        >
                            <x-slot name="iconName">
                                <x-icon name="home" class="w-6 h-6"/>
                            </x-slot>
                        </x-sidebar.nav-item>

                    

                    <x-sidebar.nav-item
                        title="State"
                        activeUrl="RefState"
                        route="{{ route('state.list') }}"
                    >
                        <x-slot name="iconName">
                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z"/>
                            </svg>
                              
                        </x-slot>
                    </x-sidebar.nav-item>

                    <x-sidebar.nav-item
                        title="Relationship"
                        activeUrl="RefRelationship"
                        route="{{ route('relationship.list') }}"
                    >
                        <x-slot name="iconName">
                            <svg xmlpns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                              </svg>
                        </x-slot>
                    </x-sidebar.nav-item>

                    <x-sidebar.nav-item
                    title="Religion"
                    activeUrl="RefReligion"
                    route="{{ route('religion.list') }}"
                >
                    <x-slot name="iconName">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 640 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M400 0c5 0 9.8 2.4 12.8 6.4c34.7 46.3 78.1 74.9 133.5 111.5l0 0 0 0c5.2 3.4 10.5 7 16 10.6c28.9 19.2 45.7 51.7 45.7 86.1c0 28.6-11.3 54.5-29.8 73.4H221.8c-18.4-19-29.8-44.9-29.8-73.4c0-34.4 16.7-66.9 45.7-86.1c5.4-3.6 10.8-7.1 16-10.6l0 0 0 0C309.1 81.3 352.5 52.7 387.2 6.4c3-4 7.8-6.4 12.8-6.4zM288 512V440c0-13.3-10.7-24-24-24s-24 10.7-24 24v72H192c-17.7 0-32-14.3-32-32V352c0-17.7 14.3-32 32-32H608c17.7 0 32 14.3 32 32V480c0 17.7-14.3 32-32 32H560V440c0-13.3-10.7-24-24-24s-24 10.7-24 24v72H448V454c0-19-8.4-37-23-49.2L400 384l-25 20.8C360.4 417 352 435 352 454v58H288zM70.4 5.2c5.7-4.3 13.5-4.3 19.2 0l16 12C139.8 42.9 160 83.2 160 126v2H0v-2C0 83.2 20.2 42.9 54.4 17.2l16-12zM0 160H160V296.6c-19.1 11.1-32 31.7-32 55.4V480c0 9.6 2.1 18.6 5.8 26.8c-6.6 3.4-14 5.2-21.8 5.2H48c-26.5 0-48-21.5-48-48V176 160z"/>
                        </svg>
                          
                    </x-slot>
                </x-sidebar.nav-item>

                    </ul>
                </div>
            </div>
        </div>
    </aside>
</div>

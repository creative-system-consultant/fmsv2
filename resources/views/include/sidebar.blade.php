
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
        }">
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

                        <!-- / -->
                        <x-sidebar.nav-item
                            title="Dashboard"
                            activeUrl="home"
                            route="{{ route('home') }}">
                            <x-slot name="iconName">
                                <x-icon name="home" class="w-6 h-6"/>
                            </x-slot>
                        </x-sidebar.nav-item>

                        <!-- cif -->
                        <x-sidebar.nav-item
                            title="Member Info"
                            activeUrl="cif"
                            route="{{ route('cif.main') }}">
                            <x-slot name="iconName">
                                <x-icon name="home" class="w-6 h-6"/>
                            </x-slot>
                        </x-sidebar.nav-item>

                        <!-- /Admin/Maintenance/State -->
                        <x-sidebar.nav-item
                            title="State"
                            activeUrl="RefState"
                            route="{{ route('state.list') }}">
                            <x-slot name="iconName">
                                <x-icon name="globe" class="w-6 h-6"/>
                            </x-slot>
                        </x-sidebar.nav-item>

                        <x-sidebar.nav-item
                            title="Relationship"
                            activeUrl="RefRelationship"
                            route="{{ route('relationship.list') }}">
                            <x-slot name="iconName">
                                <x-icon name="user-group" class="w-6 h-6"/>
                            </x-slot>
                        </x-sidebar.nav-item>

                        <x-sidebar.nav-item
                            title="Religion"
                            activeUrl="RefReligion"
                            route="{{ route('religion.list') }}">
                            <x-slot name="iconName">
                                <x-icon name="moon" class="w-6 h-6"/>
                            </x-slot>
                        </x-sidebar.nav-item>

                        <x-sidebar.nav-item
                            title="Race"
                            activeUrl="race"
                            route="{{ route('race.list') }}">
                            <x-slot name="iconName">
                                <x-icon name="user" class="w-6 h-6"/>
                            </x-slot>
                        </x-sidebar.nav-item>

                        <x-sidebar.nav-item
                            title="GL Code"
                            activeUrl="glcode"
                            route="{{ route('glcode.list') }}">
                            <x-slot name="iconName">
                                <x-icon name="home" class="w-6 h-6"/>
                            </x-slot>
                        </x-sidebar.nav-item>


                        <x-sidebar.nav-item
                            title="Gender"
                            activeUrl="RefGender"
                            route="{{ route('gender.list') }}">
                            <x-slot name="iconName">
                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 640 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M176 288a112 112 0 1 0 0-224 112 112 0 1 0 0 224zM352 176c0 86.3-62.1 158.1-144 173.1V384h32c17.7 0 32 14.3 32 32s-14.3 32-32 32H208v32c0 17.7-14.3 32-32 32s-32-14.3-32-32V448H112c-17.7 0-32-14.3-32-32s14.3-32 32-32h32V349.1C62.1 334.1 0 262.3 0 176C0 78.8 78.8 0 176 0s176 78.8 176 176zM271.9 360.6c19.3-10.1 36.9-23.1 52.1-38.4c20 18.5 46.7 29.8 76.1 29.8c61.9 0 112-50.1 112-112s-50.1-112-112-112c-7.2 0-14.3 .7-21.1 2c-4.9-21.5-13-41.7-24-60.2C369.3 66 384.4 64 400 64c37 0 71.4 11.4 99.8 31l20.6-20.6L487 41c-6.9-6.9-8.9-17.2-5.2-26.2S494.3 0 504 0H616c13.3 0 24 10.7 24 24V136c0 9.7-5.8 18.5-14.8 22.2s-19.3 1.7-26.2-5.2l-33.4-33.4L545 140.2c19.5 28.4 31 62.7 31 99.8c0 97.2-78.8 176-176 176c-50.5 0-96-21.3-128.1-55.4z"/>
                                </svg>
                            </x-slot>
                        </x-sidebar.nav-item>

                        <x-sidebar.nav-item
                            title="Title"
                            activeUrl="RefTitle"
                            route="{{ route('title.list') }}">
                            <x-slot name="iconName">
                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 640 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M144 0a80 80 0 1 1 0 160A80 80 0 1 1 144 0zM512 0a80 80 0 1 1 0 160A80 80 0 1 1 512 0zM0 298.7C0 239.8 47.8 192 106.7 192h42.7c15.9 0 31 3.5 44.6 9.7c-1.3 7.2-1.9 14.7-1.9 22.3c0 38.2 16.8 72.5 43.3 96c-.2 0-.4 0-.7 0H21.3C9.6 320 0 310.4 0 298.7zM405.3 320c-.2 0-.4 0-.7 0c26.6-23.5 43.3-57.8 43.3-96c0-7.6-.7-15-1.9-22.3c13.6-6.3 28.7-9.7 44.6-9.7h42.7C592.2 192 640 239.8 640 298.7c0 11.8-9.6 21.3-21.3 21.3H405.3zM224 224a96 96 0 1 1 192 0 96 96 0 1 1 -192 0zM128 485.3C128 411.7 187.7 352 261.3 352H378.7C452.3 352 512 411.7 512 485.3c0 14.7-11.9 26.7-26.7 26.7H154.7c-14.7 0-26.7-11.9-26.7-26.7z"/>
                                </svg>
                            </x-slot>
                        </x-sidebar.nav-item>

                        <x-sidebar.nav-item
                            title="Marital"
                            activeUrl="RefMarital"
                            route="{{ route('marital.list') }}">
                            <x-slot name="iconName">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                  </svg>
                            </x-slot>
                        </x-sidebar.nav-item>
                        

                        <x-sidebar.nav-item
                            title="Education"
                            activeUrl="education"
                            route="{{ route('education.list') }}">
                            <x-slot name="iconName">
                                <x-icon name="home" class="w-6 h-6"/>
                            </x-slot>
                        </x-sidebar.nav-item>

                        <x-sidebar.nav-item
                            title="Bank"
                            activeUrl="bank"
                            route="{{ route('bank.list') }}">
                            <x-slot name="iconName">
                                <x-icon name="home" class="w-6 h-6"/>
                            </x-slot>
                        </x-sidebar.nav-item>

                        <x-sidebar.nav-item
                            title="Country"
                            activeUrl="country"
                            route="{{ route('country.list') }}">
                            <x-slot name="iconName">
                                <x-icon name="home" class="w-6 h-6"/>
                            </x-slot>
                        </x-sidebar.nav-item>
                    </ul>
                </div>
            </div>
        </div>
    </aside>
</div>

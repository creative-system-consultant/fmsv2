
<div x-cloak >
    <aside
        x-cloak
        class="fixed top-0 left-0 flex flex-col flex-shrink-0 h-full duration-75 lg:flex transition-width"
        :class="{
            'block lg:hidden z-0': toggleSidebarDesktop,
            'w-64 lg:w-[5rem] z-20': toggleMiniSidebar,
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

                        <!-- Home -->
                        <x-sidebar.nav-item
                            title="Dashboard"
                            activeUrl="home"
                            route="{{ route('home') }}">
                            <x-slot name="iconName">
                                <x-icon name="home" class="w-6 h-6"/>
                            </x-slot>
                        </x-sidebar.nav-item>

                        <!-- Start Cif -->
                        <x-sidebar.nav-item
                            title="Member Info"
                            activeUrl="cif/*"
                            route="{{ route('cif.main') }}">
                            <x-slot name="iconName">
                                <x-icon name="user-group" class="w-6 h-6"/>
                            </x-slot>
                        </x-sidebar.nav-item>
                        <!-- End Cif -->

                        <!-- Start teller -->
                        <x-sidebar.nav-item
                            title="Teller"
                            activeUrl="teller/*"
                            route="{{ route('teller.teller-list') }}">
                            <x-slot name="iconName">
                                <x-icon name="currency-dollar" class="w-6 h-6"/>
                            </x-slot>
                        </x-sidebar.nav-item>
                        <!-- End teller -->


                        <! -- Start setting module -->
                        <x-sidebar.dropdown-nav
                            activeUrl="Admin/*"
                            title="Setting"
                            >
                            <x-slot name="iconName">
                                <x-icon name="cog" class="w-6 h-6"/>
                            </x-slot>
                            
                            <x-slot name="navItem">
                                <! -- Start Maintenance -->
                                <x-sidebar.dropdown-nav-child
                                    title="Maintenance"
                                    activeUrl=""
                                    >
                                    <x-slot name="navitem">
                                        <x-sidebar.dropdown-nav-item
                                            title="State"
                                            activeUrl="url-page"
                                            route="{{ route('state.list') }}"
                                        />
                                        <x-sidebar.dropdown-nav-item
                                            title="Relationship"
                                            activeUrl="RefRelationship"
                                            route="{{ route('relationship.list') }}"
                                        />

                                        <x-sidebar.dropdown-nav-item
                                            title="Religion"
                                            activeUrl="RefReligion"
                                            route="{{ route('religion.list') }}"
                                        />
                                        <x-sidebar.dropdown-nav-item
                                            title="Race"
                                            activeUrl="race"
                                            route="{{ route('race.list') }}"
                                        />
                                        <x-sidebar.dropdown-nav-item
                                            title="GL Code"
                                            activeUrl="glcode"
                                            route="{{ route('glcode.list') }}"
                                        />
                                        <x-sidebar.dropdown-nav-item
                                            title="Gender"
                                            activeUrl="RefGender"
                                            route="{{ route('gender.list') }}"
                                        />
                                        <x-sidebar.dropdown-nav-item
                                            title="Title"
                                            activeUrl="RefTitle"
                                            route="{{ route('title.list') }}"
                                        />
                                        <x-sidebar.dropdown-nav-item
                                            title="Marital"
                                            activeUrl="RefMarital"
                                            route="{{ route('marital.list') }}"
                                        />
                                        <x-sidebar.dropdown-nav-item
                                            title="Education"
                                            activeUrl="education"
                                            route="{{ route('education.list') }}"
                                        />
                                        <x-sidebar.dropdown-nav-item
                                            title="Bank"
                                            activeUrl="bank"
                                            route="{{ route('bank.list') }}"
                                        />
                                        <x-sidebar.dropdown-nav-item
                                            title="Country"
                                            activeUrl="country"
                                            route="{{ route('country.list') }}"
                                        />
                                    </x-slot>
                                </x-sidebar.dropdown-nav-child>
                                <! -- End Maintenance -->
                            </x-slot>
                        </x-sidebar.dropdown-nav>
                        <! -- End setting module -->
                    </ul>
                </div>
            </div>
        </div>
    </aside>
</div>

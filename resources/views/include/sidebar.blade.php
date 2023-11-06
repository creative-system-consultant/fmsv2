
<div x-cloak >
    <aside
        @mouseover="openHoverMiniSidebar = true"
        @mouseover.away = "openHoverMiniSidebar = false"
        x-cloak
        class="fixed top-0 left-0 flex flex-col flex-shrink-0 h-full duration-75 lg:flex transition-width"
        x-bind:class="{
            'block lg:hidden': toggleSidebarDesktop,
            'w-64 lg:w-[5rem]': toggleMiniSidebar && !openHoverMiniSidebar,
            'w-64 lg:w-[16rem] z-10': openHoverMiniSidebar,
            'w-64 z-50 lg:z-0': !toggleMiniSidebar,
            'animate__animated animate__slideInLeft': toggleSidebarMobile,
            'hidden lg:block': !toggleSidebarMobile
        }">
        <div class="relative flex flex-col flex-1 min-h-0 pt-0 border-r border-gray-200 backdrop-blur-xl bg-white/60 dark:bg-gray-900 dark:border-gray-800">
            <a href="{{ route('home') }}" class="flex items-center justify-center pt-4 text-xl font-bold">
                <div x-show="!toggleMiniSidebar">
                    <x-logo class="w-auto h-12" />
                </div>
                <div x-show="toggleMiniSidebar">
                    <x-logo class="w-auto h-12 "  x-bind:class="openHoverMiniSidebar ? 'lg:h-12' : 'lg:h-6'" />
                </div>
            </a>
            <div class="flex flex-col flex-1 pt-5 pb-4 "
                :class="toggleMiniSidebar == true ? '' : 'overflow-y-auto'">
                <div class="flex-1 px-3 space-y-1 divide-y">
                    <ul class="pt-4 pb-2 space-y-2 list-none">
                        <div class="block pb-6 lg:hidden">
                            <x-toggle-theme/>
                        </div>

                        @can('access dashboard')
                            <!-- Home -->
                            <x-sidebar.nav-item
                                title="Dashboard"
                                activeUrl="home"
                                route="{{ route('home') }}">
                                <x-slot name="iconName">
                                    <x-icon name="home" class="w-6 h-6"/>
                                </x-slot>
                            </x-sidebar.nav-item>
                        @endcan

                        @can('access roles and permissions')
                            <!-- Users -->
                            <x-sidebar.nav-item
                                title="User Management"
                                activeUrl="user-management"
                                route="{{ route('userManagement') }}">
                                <x-slot name="iconName">
                                    <x-icon name="user-group" class="w-6 h-6"/>
                                </x-slot>
                            </x-sidebar.nav-item>

                            <!-- Roles -->
                            <x-sidebar.nav-item
                                title="Roles"
                                activeUrl="roles"
                                route="{{ route('roles.index') }}">
                                <x-slot name="iconName">
                                    <x-icon name="shield-check" class="w-6 h-6"/>
                                </x-slot>
                            </x-sidebar.nav-item>

                            <!-- Permission -->
                            <x-sidebar.nav-item
                                title="Permission"
                                activeUrl="permissions"
                                route="{{ route('permissions.index') }}">
                                <x-slot name="iconName">
                                    <x-icon name="shield-exclamation" class="w-6 h-6"/>
                                </x-slot>
                            </x-sidebar.nav-item>
                        @endcan

                        @can('access member info')
                            <!-- Start Cif -->
                            <x-sidebar.nav-item
                                title="Member Info"
                                activeUrl="cif/*"
                                route="{{ route('cif.main') }}">
                                <x-slot name="iconName">
                                    <x-icon name="user-group" class="w-6 h-6"/>
                                </x-slot>
                            </x-sidebar.nav-item>
                        @endcan

                        @can('access financing info')
                            <!-- Start finance -->
                            <x-sidebar.nav-item
                                title="Financing Info"
                                activeUrl="finance/*"
                                route="{{ route('finance.finance-financing-info') }}">
                                <x-slot name="iconName">
                                    <x-icon name="database" class="w-6 h-6"/>
                                </x-slot>
                            </x-sidebar.nav-item>
                        @endcan

                        @can('access other info')
                            <!-- Start Other Info -->
                            <x-sidebar.nav-item
                                title="Other Info"
                                activeUrl="other/*"
                                route="{{ route('other.info-list') }}">
                                <x-slot name="iconName">
                                    <x-icon name="collection" class="w-6 h-6"/>
                                </x-slot>
                            </x-sidebar.nav-item>
                        @endcan

                        @can('access teller')
                            <!-- Start teller -->
                            <x-sidebar.nav-item
                                title="Teller"
                                activeUrl="teller/*"
                                route="{{ route('teller.teller-list') }}">
                                <x-slot name="iconName">
                                    <x-icon name="currency-dollar" class="w-6 h-6"/>
                                </x-slot>
                            </x-sidebar.nav-item>
                        @endcan

                        @can('access reversal')
                            <!-- Start Reversal -->
                            <x-sidebar.nav-item
                                title="Reversal"
                                activeUrl="reversal/*"
                                route="{{ route('reversal.reversal-list') }}">
                                <x-slot name="iconName">
                                    <x-icon name="refresh" class="w-6 h-6"/>
                                </x-slot>
                            </x-sidebar.nav-item>
                        @endcan

                        @can('access calculator')
                            <!-- Start Calculator -->
                            <x-sidebar.nav-item
                                title="Calculator"
                                activeUrl="calculator/*"
                                route="{{ route('calculator.calculator-index') }}">
                                <x-slot name="iconName">
                                    <x-icon name="calculator" class="w-6 h-6"/>
                                </x-slot>
                            </x-sidebar.nav-item>
                        @endcan

                        @can('access dividen')
                            <!-- Start Dividen -->
                            <x-sidebar.nav-item
                                title="Dividen"
                                activeUrl="dividen/*"
                                route="{{ route('dividen.dividen-index') }}">
                                <x-slot name="iconName">
                                    <x-icon name="presentation-chart-line" class="w-6 h-6"/>
                                </x-slot>
                            </x-sidebar.nav-item>
                        @endcan

                        @can('access report')
                            <!-- Start Report -->
                            <x-sidebar.nav-item
                                title="Report"
                                activeUrl="report/*"
                                route="{{ route('report.report-list') }}">
                                <x-slot name="iconName">
                                    <x-icon name="clipboard-list" class="w-6 h-6"/>
                                </x-slot>
                            </x-sidebar.nav-item>
                        @endcan

                        @can('setting')
                            <!-- Start Report -->
                            <x-sidebar.nav-item
                                title="Setting"
                                activeUrl="Admin/*"
                                route="{{ route('setting.setting-list') }}">
                                <x-slot name="iconName">
                                    <x-icon name="cog" class="w-6 h-6"/>
                                </x-slot>
                            </x-sidebar.nav-item>
                        @endcan
                    </ul>
                </div>
            </div>
        </div>
    </aside>
</div>

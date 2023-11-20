
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
            <livewire:layout.sidebar-tag />

            <div class="flex flex-col flex-1 pb-4 "
                :class="toggleMiniSidebar == true ? '' : 'overflow-y-auto'">
                <div class="flex-1 px-3 space-y-1 divide-y">
                    <ul class="pt-4 pb-2 space-y-2 list-none">
                        <div class="fixed bottom-0 left-0 right-0 block pb-6 lg:hidden">
                            <div class="flex items-center justify-center">
                                <x-toggle-theme/>
                            </div>
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

                        @foreach(config('module.sidebar') as $item)
                            @php
                                $hasPermission = auth()->check() && auth()->user()->hasClientSpecificPermission($item['permission'], auth()->user()->client_id);
                            @endphp

                            @if($hasPermission)
                                <x-sidebar.nav-item
                                    title="{{ $item['title'] }}"
                                    activeUrl="{{ $item['activeUrl'] }}"
                                    route="{{ route($item['route']) }}">
                                    <x-slot name="iconName">
                                        <x-icon name="{{ $item['icon'] }}" class="w-6 h-6"/>
                                    </x-slot>
                                </x-sidebar.nav-item>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </aside>
</div>
